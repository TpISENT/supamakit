<?php

if ( ! function_exists( 'tokoo_vertical_menu_element' ) ) :

    function tokoo_vertical_menu_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'menu_title'        => '',
            'menu_action_text'  => '',
            'menu_action_link'  => '',
            'menu'              => '',
        ), $atts));

        $args = array(
            'menu_title'        => $menu_title,
            'menu_action_text'  => $menu_action_text,
            'menu_action_link'  => $menu_action_link,
            'menu'              => $menu,
        );

        $html = '';
        if( function_exists( 'tokoo_vertical_nav' ) ) {
            ob_start();
            tokoo_vertical_nav( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

    add_shortcode( 'tokoo_vertical_menu' , 'tokoo_vertical_menu_element' );

endif;