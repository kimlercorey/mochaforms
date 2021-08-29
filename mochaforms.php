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

// if (file_exists( dirname( __FILE__) . '/vendor/autoload.php')) {
//     require_once dirname( __FILE__) . '/vendor/autoload.php';
// }


class MochaForms {
    
    public $plugin_name;
    public $plugin_path; 

    function __construct() {
        $this->plugin_name = plugin_basename( __FILE__ );
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->init();
    }

    // uninstall is handle via uninstall.php which is automatically invoked on uninstall 

    function custom_post_type() {
        register_post_type( 'form', ['public' => true, 'label' => 'Forms'] );
    }

    function admin_enqueue(){
        // enqueue scripts from assets
        wp_enqueue_style( 'mochaform_style', plugins_url( '/assets/admin_style.css', __FILE__ ) );
        wp_enqueue_script( 'mochaform_script', plugins_url( '/assets/admin_script.js', __FILE__ ) );
    }

    function client_enqueue(){
        // enqueue scripts from assets
        wp_enqueue_style( 'mochaform_client_style', plugins_url( '/assets/style.css', __FILE__ ) );
        wp_enqueue_script( 'mochaform_client_script', plugins_url( '/assets/script.js', __FILE__ ) );
    }

    protected function init(){
        add_action( 'init', array( $this, 'custom_post_type') );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue') );
        add_action( 'wp_enqueue_scripts', array( $this, 'client_enqueue') );
        //$this->custom_post_type();

        add_action( 'admin_menu', [$this, 'admin_menu_pages'] );
        add_filter( "plugin_action_links_$this->plugin_name" , array($this, 'settings_link') );
    }

    function settings_link($links){
         // add custom settings links
         $settings_link = '<a href="admin.php?page=mocha_forms">Settings</a>';
         array_push($links, $settings_link);
         return $links;
    }

    function admin_menu_pages() {    
        add_menu_page( 'Mocha Forms', 'MochaForms', 'manage_options', 'mocha_forms', array($this, 'admin_index'), 'dashicons-feedback', null );
    }

    function admin_index() {
        // Require templates
        require_once $this->plugin_path . 'templates/admin.php';
    }

    function activate(){
        Util::activate();
    }

    function deactivate(){
        Util::deactivate();
    }

    static function autoload($path='inc'){
        $dir = new RecursiveDirectoryIterator(plugin_dir_path( __FILE__ ) . $path);
        foreach ( new RecursiveIteratorIterator($dir) as $file) {
            if (!is_dir($file)) {
                if( fnmatch('*.php', $file) ) 
                require_once $file;
            }
        }
    }
}

if ( class_exists( 'MochaForms' ) ) {
    $mochaForms = new MochaForms();
    MochaForms::autoload();
}

register_activation_hook( __FILE__, array($mochaForms, 'activate') );
register_deactivation_hook( __FILE__, array($mochaForms, 'deactivate') );
