<?php
/**
 * Tokoo Our Team hooks
 *
 * @package Tokoo
 */

/**
 * Filters
 */
add_filter( 'woothemes_our_team_member_fields',		'tokoo_add_team_member_fields');

add_action( 'team_members_loop_content',            'our_team_member_archive_social_links', 30 );