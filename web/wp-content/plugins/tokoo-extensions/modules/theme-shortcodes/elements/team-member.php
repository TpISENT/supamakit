<?php

if ( ! function_exists( 'tokoo_team_member_element' ) ) {

    function tokoo_team_member_element( $atts, $content = null ){

        extract(shortcode_atts(array(
        	'section_title'     => '',
            'limit'             => '',
            'orderby'           => '',
            'order'             => '',
            'category'          => ''
        ), $atts));

        $section_args = array(
        	'section_title'     => $section_title,
        );

        $taxonomy_args = array(
            'limit'         => $limit,
            'orderby'       => $orderby,
            'order'         => $order,
            'category'      => $category
        );
    

        $html = '';
        if( function_exists( 'tokoo_testimonial' ) ) {
            ob_start();
            tokoo_testimonial( $section_args, $taxonomy_args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'tokoo_testimonial' , 'tokoo_team_member_element' );