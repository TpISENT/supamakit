<?php

if ( ! function_exists( 'tokoo_job_section_element' ) ) {

    function tokoo_job_section_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'    => '',
            'el_class'         => '',
            'jobs'             => array()
        ), $atts));

        if( is_object( $jobs ) || is_array( $jobs ) ) {
            $jobs = json_decode( json_encode( $jobs ), true );
        } else {
            $jobs = json_decode( urldecode( $jobs ), true );
        }

        $args = array(
            'section_title'     => $section_title,
            'section_class'     => $el_class,
            'jobs'              => $jobs
        );

        $html = '';
        if( function_exists( 'tokoo_job_section' ) ) {
            ob_start();
            tokoo_job_section( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'tokoo_job_section' , 'tokoo_job_section_element' );