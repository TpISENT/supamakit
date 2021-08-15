<?php

/**
 * Description of E2W_Attachment
 *
 * @author Andrey
 */
if (!class_exists('E2W_Attachment')) {

    class E2W_Attachment {

        private $utils;
        private $use_external_image_urls = false;

        public function __construct($use_external = 'cfg') {
            $this->utils = new E2W_Utils();
            if ('external' === $use_external || 'local' === $use_external) {
                $this->use_external_image_urls = ('external' === $use_external);
            } else {
                $this->use_external_image_urls = e2w_get_setting('use_external_image_urls');
            }
        }

        public function create_attachment($post_id, $image_path, $title = null, $alt = null, $check_duplicate = true) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            
            $image_path = E2W_Utils::clear_image_url($image_path);
            
            if($check_duplicate){
                $res = get_posts(array('post_type' => 'attachment','fields' => 'ids','numberposts' => -1,'meta_query' => array(array('key' => '_e2w_external_image_url','value' => $image_path))));
                if(!empty($res)){
                    return $res[0];
                }
            }

            if ($this->use_external_image_urls) {
                // attach image as remote url
                if (empty($post_id) || empty($image_path)) {
                    return false;
                }
                
                // remove _640x640.jpg from image url filename.jpg_640x640.jpg
                //$image_path = preg_replace("/(.+)(.jpg)(_[0-9]+x[0-9]+.jpg)/", "$1$2", $image_path);
                $image_path = preg_replace("/(.+?)(.jpg|.jpeg)(.*)/", "$1$2", $image_path);
                
                $wp_filetype = wp_check_filetype(basename($image_path), null);

                $image_name = preg_replace('/\.[^.]+$/', '', basename($image_path));
                if (!empty($desc)) {
                    $image_name = $desc;
                }

                $image_name = sanitize_file_name($image_name);
                $image_name = preg_replace("/[^a-zA-Z0-9-]/", "", $image_name);
                $image_name = substr($image_name, 0, 200);

                $attachment = array(
                    'guid' => $image_path,
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => empty($title)?$image_name:$title,
                    'post_excerpt' => empty($title)?$image_name:$title,
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $image_path, $post_id);

                if (!$attach_id)
                    return false;

                $this->set_attachment_metadata($attach_id, $image_path);
                
                update_post_meta($attach_id, '_e2w_external_image_url', $image_path);
                
                if(!empty($alt)){
                    update_post_meta($attach_id, '_wp_attachment_image_alt', $alt);    
                }
                
                return $attach_id;
            }else {
                // attach image as upload
                $image = $this->download_url($image_path);
                if ($image) {
                    $file_array = array(
                        'name' => basename($image),
                        'size' => filesize($image),
                        'tmp_name' => $image
                    );
                    $attach_id = media_handle_sideload($file_array, $post_id, $title);
                    
                    if($attach_id){
                        update_post_meta($attach_id, '_e2w_external_image_url', $image_path);
                        if(!empty($title)){
                            wp_update_post(array('ID' => $attach_id, 'post_excerpt'   => $title));
                        }
                        if(!empty($alt)){
                            update_post_meta($attach_id, '_wp_attachment_image_alt', $alt);    
                        }
                    }
                    
                    return $attach_id;
                } else {
                    return false;
                }
            }
        }

        private function download_url($url) {
            $wp_upload_dir = wp_upload_dir();
            $parsed_url = parse_url($url);
            $pathinfo = pathinfo($parsed_url['path']);
            if (!$pathinfo || !isset($pathinfo['extension'])) {
                return false;
            }
            $dest_filename = wp_unique_filename($wp_upload_dir['path'], mt_rand() . "." . $pathinfo['extension']);

            $dest_path = $wp_upload_dir['path'] . '/' . $dest_filename;

            $response = e2w_remote_get($url);
            if (is_wp_error($response)) {
                return false;
            } elseif (!in_array($response['response']['code'], array(404, 403))) {
                file_put_contents($dest_path, $response['body']);
            }

            if (!file_exists($dest_path)) {
                return false;
            } else {
                return $dest_path;
            }
        }

        private function set_attachment_metadata($attach_id, $image_url) {
            update_post_meta($attach_id, '_wp_e2w_attached_file', 1);

            $image_sizes = array('large'=>array('url' => $image_url, 'width' => 800, 'height' => 800));

            $attach_data = array(
                'file' => 0,
                'width' => 0,
                'height' => 0,
                'sizes' => array(),
                'image_meta' => array(
                    'aperture' => '0',
                    'credit' => '',
                    'camera' => '',
                    'caption' => '',
                    'created_timestamp' => '0',
                    'copyright' => '',
                    'focal_length' => '0',
                    'iso' => '0',
                    'shutter_speed' => '0',
                    'title' => '',
                    'orientation' => '0',
                    'keywords' => array(),
                ),
            );

            $attach_data = array_replace_recursive($attach_data, array(
                'file' => $image_sizes['large']['url'],
                'width' => $image_sizes['large']['width'],
                'height' => $image_sizes['large']['height'],
            ));

            $wp_sizes = $this->utils->get_image_sizes();
            foreach ($wp_sizes as $size => $props) {
                $found_size = $this->_choose_image_size_from_ebay($props, $image_sizes);

                if (!empty($found_size)) {
                    $wp_filetype = wp_check_filetype(basename($found_size['url']), null);
                    $attach_data['sizes']["$size"] = array(
                        'file' => basename($found_size['url']),
                        'width' => $found_size['width'],
                        'height' => $found_size['height'],
                        'mime-type' => $wp_filetype['type'],
                    );
                }
            }

            wp_update_attachment_metadata($attach_id, $attach_data);
        }

        private function _choose_image_size_from_ebay($size, $image_sizes = array()) {
            if (empty($image_sizes)) {
                return false;
            }


            $min_size = $max_size = false;
            foreach ($image_sizes as $props) {
                if ((int) $size['width'] == (int) $props['width']) {
                    return $props;
                }

                if (intval($size['width']) < intval($props['width']) && (!$min_size || intval($min_size['width']) > intval($props['width']))) {
                    $min_size = $props;
                }

                if (!$max_size || (intval($max_size['width']) < intval($props['width']))) {
                    $max_size = $props;
                }
            }

            return !$min_size ? $max_size : $min_size;
        }

        public static function find_products_with_external_images() {
            global $wpdb;
            $result_ids = array();
            $tmp_product_ids = $wpdb->get_results("select distinct if(p.post_parent = 0, p.id, p.post_parent) as id from $wpdb->posts p, (select distinct p1.post_parent as id from $wpdb->posts p1 LEFT join $wpdb->postmeta pm1 on(p1.id = pm1.post_id) where p1.post_type = 'attachment' and pm1.meta_key='_wp_e2w_attached_file' and pm1.meta_value='1') pp WHERE p.ID = pp.id", ARRAY_N);
            foreach ($tmp_product_ids as $row) {
                $result_ids[] = $row[0];
            }
            return $result_ids;
        }

        public static function calc_total_external_images() {
            global $wpdb;
            $cnt = $wpdb->get_var("select count(id) from (select distinct p1.id as id from $wpdb->posts p1 LEFT join $wpdb->postmeta pm1 on(p1.id = pm1.post_id) where p1.post_type = 'attachment' and pm1.meta_key='_wp_e2w_attached_file' and pm1.meta_value='1') as pp");
            $cnt += $wpdb->get_var("select count(ID) from $wpdb->posts where post_content LIKE '%.alicdn.com%'");
            
            return $cnt;
        }

        public static function find_external_images($page_size = 1000) {
            global $wpdb;
            $result_ids = array();
            $tmp_product_ids = $wpdb->get_results("select distinct p1.id as id from $wpdb->posts p1 LEFT join $wpdb->postmeta pm1 on(p1.id = pm1.post_id) where p1.post_type = 'attachment' and pm1.meta_key='_wp_e2w_attached_file' and pm1.meta_value='1' LIMIT $page_size", ARRAY_N);
            foreach ($tmp_product_ids as $row) {
                $result_ids[] = $row[0];
            }

            $tmp_product_ids = $wpdb->get_results("select ID from $wpdb->posts where post_content LIKE '%alicdn.com%'", ARRAY_N);
            foreach ($tmp_product_ids as $row) {
                $result_ids[] = $row[0];
            }

            return $result_ids;
        }

        public function load_external_image($post_id) {
            global $wpdb;
            
            if ($post_id) {
                $post_id = intval($post_id);
                $post = get_post($post_id);
                if ($post->post_type === 'attachment') {
                    $tmp = get_post_meta($post_id, '_wp_e2w_attached_file', true);
                    if ($tmp && intval($tmp) === 1) {

                        $new_image_id = $this->create_attachment($post->post_parent, $post->guid, $post->post_title, $post->post_title, false);                        
                        if ($new_image_id) {
                            $wpdb->query("UPDATE $wpdb->postmeta SET meta_value = '$new_image_id' WHERE meta_key = '_thumbnail_id' AND meta_value = '$post_id'");
            
                            $res = $wpdb->get_results("select meta_id, post_id, meta_key, meta_value FROM $wpdb->postmeta WHERE meta_key='_product_image_gallery'", ARRAY_A);
                            foreach($res as $row){
                                $tmp_id_list = explode(',', $row['meta_value']);
                                $tmp_id_list_res = array();
                                foreach($tmp_id_list as $id_str){
                                    if(intval($id_str)>0){
                                        if(intval($id_str) === $post_id){
                                            $tmp_id_list_res[]=$new_image_id;
                                        }else{
                                            $tmp_id_list_res[]=intval($id_str);
                                        }
                                    }
                                }
                                $wpdb->query("UPDATE $wpdb->postmeta SET meta_value = '".implode(',', $tmp_id_list_res)."' WHERE meta_id = '".$row['meta_id']."'");
                            }
                            
                            wp_delete_attachment($post_id, true);
                            $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id = " . $post_id);
                            wp_delete_post($post_id, true);
                        }
                    }
                } else {
                    if (function_exists('libxml_use_internal_errors')) { libxml_use_internal_errors(true); }
                    $dom = new DOMDocument();
                    @$dom->loadHTML($post->post_content);
                    $dom->formatOutput = true;

                    $elements = $dom->getElementsByTagName('img');
                    $replace_map = array();
                    for ($i = $elements->length; --$i >= 0;) {
                        $e = $elements->item($i);
                        $old_url = strval($e->getAttribute('src'));
                        $tmp = parse_url($old_url);
                        $old_url = $tmp['scheme']."://".$tmp['host'].$tmp['path'];
                        
                        if (strpos($old_url, '.alicdn.com') !== false) {
                            $attachment_id = $this->create_attachment($post_id, $e->getAttribute('src'), $post->post_title, $post->post_title, false);
                            $new_url = wp_get_attachment_url($attachment_id);
                            
                            $replace_map[$old_url] = $new_url;
                            //$post->post_content = str_replace($old_url, $new_url, $post->post_content);
                            //wp_update_post( array('ID' => $post_id,'post_content' => $post->post_content) );
                        }
                    }
                    $post->post_content = str_replace(array_keys($replace_map), array_values($replace_map), $post->post_content);
                    wp_update_post( array('ID' => $post_id,'post_content' => $post->post_content));
                }

            } else {
                throw new Exception("load_external_image: waiting for ID...");
            }
        }

    }

}
