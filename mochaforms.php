<?php
/**
 *  @package MochaForms
 */
/*
Plugin Name: MochaForms
Plugin URI: http://mochaforms.com/plugin
Description: A complete form generator solution for wordpress focused on simple setup.
Version: 1.0.5
Author: MochaForms
Author URI: http://mochaforms.com/
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
 * This is an add-on for WordPress <http://wordpress.org/>
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

// Ensure Wordperfect context
defined( 'ABSPATH') or die( 'Missing Wordpress Context' );

//Require Once Class Auto loader
require_once dirname( __FILE__) . '/inc/base/util.class.php';

final class MochaForms {
    
    public $admin;

    function __construct() {
        define( 'MF_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
        define( 'MF_PLUGIN_NAME', plugin_basename( __FILE__ ) );
        define( 'MF_PLUGINS_URL', plugins_url( '', __FILE__ ) );

        $this->init();
        Util::autoload();

        $this->admin = new Admin();

        register_activation_hook( __FILE__, ['Util', 'activate'] );
        register_deactivation_hook( __FILE__, ['Util', 'deactivate'] );
    }

    function menuPages(){
        $this->admin->menu_pages();
    }

    protected function init(){ 
        add_action( 'init', ['Client', 'custom_post_type'] );
        add_action( 'wp_enqueue_scripts', ['Client', 'client_enqueue'] );
        //add_action( 'admin_enqueue_scripts',  [$this->admin, 'admin_enqueue'] );
        add_action( 'admin_menu', [$this, 'menuPages'] );

        add_filter( 'plugin_action_links_'.MF_PLUGIN_NAME , ['Admin', 'settings_link'] );
    }
}

if ( class_exists( 'MochaForms' ) ) {
    $mochaForms = new MochaForms();
    
}