<?php
/**
 *  @package MochaForms
 */
/*
Plugin Name: MochaForms
Plugin URI: http://mochaforms.com/plugin
Description: A complete form generator solution for wordpress focused on simple setup.
Version: 1.0.0
Author: MochaForms Team
Author URI: http://mochaforms.com/team
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: mochaforms
 */



/**
* Plugin action links
*
* @param array $links
*
* @return array
*/

public function plugin_action_links( $links ) {
    $links[] = '<a href="https://mochaforms.com/?utm_source=mochaforms-action-link&utm_medium=textlink&utm_campaign=plugin-docs-link" target="_blank">' . __( 'Docs', 'mochaforms' ) . '</a>';
    $links[] = '<a href="' . admin_url( 'admin.php?page=mochaforms' ) . '">' . __( 'Settings', 'mochaforms' ) . '</a>';

    return $links;
}
