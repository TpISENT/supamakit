<?php
/**
 * Description of E2W_Categories
 *
 * @author User
 */
if (!class_exists('E2W_Categories')){
    class E2W_Categories {
        public static function get_categories($site='all') {
            if($site == 'all'){
                $result = array('categories'=>array());
                if (file_exists(E2W()->plugin_path . 'assets/data/categories.json')) {
                    $result = json_decode(file_get_contents(E2W()->plugin_path . 'assets/data/categories.json'), true);
                }
            }else{
                $result = array();
                if (file_exists(E2W()->plugin_path . 'assets/data/categories.json')) {
                    $result = json_decode(file_get_contents(E2W()->plugin_path . 'assets/data/categories.json'), true);
                    $s = E2W_EbaySite::get_site($site);
                    if($s && isset($result["categories"][$s->siteid])){
                        $result = $result["categories"][$s->siteid];
                    }
                }
                array_unshift($result, array("id" => "0", "name" => "All categories", "level" => 1));
            }
            
            return $result;
        }
        
        public static function save_categories($site, $categories) {
            $s = E2W_EbaySite::get_site($site);
            if($s){
                $all_categories = E2W_Categories::get_categories('all');
                $all_categories["categories"][$s->siteid] = $categories;
                file_put_contents(E2W()->plugin_path . 'assets/data/categories.json', json_encode($all_categories));
            }
        }
    }
}
