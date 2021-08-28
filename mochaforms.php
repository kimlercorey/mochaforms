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
 * Copyright (c) 2020 MochaForms LLC (email: support@mochaforms.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

final class MochaForms {

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


}