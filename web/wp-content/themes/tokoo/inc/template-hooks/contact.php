<?php
/**
 * Template Hooks used in Contact
 */


add_action( 'tokoo_before_contact', 'tokoo_contactpage_hook_control',   20 );
add_action( 'tokoo_contact', 'tokoo_contact_map',  10 );
add_action( 'tokoo_contact', 'tokoo_contact_form', 20 );