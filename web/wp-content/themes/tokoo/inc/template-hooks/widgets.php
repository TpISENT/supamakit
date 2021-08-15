<?php
/**
 * Template hooks for widgets
 */

add_filter( 'widget_pages_args', 'tokoo_modify_widget_pages_args', 10, 2 );
add_filter( 'widget_categories_args', 'tokoo_modify_widget_categories_args', 10, 2 );