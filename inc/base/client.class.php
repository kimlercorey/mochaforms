<?php
/**
 *  @package MochaForms
 */

 class Client {

    static function client_enqueue(){
        // enqueue scripts from assets
        wp_enqueue_style( 'mochaform_client_style', MF_PLUGINS_URL . '/assets/mf_style.css' );
        wp_enqueue_script( 'mochaform_client_script', MF_PLUGINS_URL . '/assets/mf_script.js' );
    }

    static function custom_post_type() {
        register_post_type( 'form', ['public' => true, 'label' => 'Forms'] );
    }

 }