<?php

if ( ! function_exists( 'tokoo_get_page_extra_class' ) ) {
    function tokoo_get_page_extra_class() {
        global $post;

        $classes = '';

        if( is_page() ) {
            $clean_page_meta_values = get_post_meta( $post->ID, '_tokoo_page_metabox', true );
            $page_meta_values = maybe_unserialize( $clean_page_meta_values );

            if( isset( $page_meta_values['body_classes'] ) ) {
                $classes = $page_meta_values['body_classes'];
            }
        }

        return $classes;
    }
}


