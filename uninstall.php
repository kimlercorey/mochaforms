<?php
/**
 *  @package MochaForms
 *
 * Triggered upon mochaforms uninstall
 */

 if ( ! defined( 'WP_UNINSTALL_PLUGIN')) {
     die;
 }

// Clear custom post type data and administrative options
//  $forms = get_posts( array( 'post_type' => 'form', 'numberposts' => -1 ) );
 
//  foreach ($forms as $form) {
//      wp_delete_post ( $form->ID, true);
//  }
 
global $wpdb;

$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'form'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT in (SELECT id FROM wp_posts)");
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT in (SELECT id FROM wp_posts)");