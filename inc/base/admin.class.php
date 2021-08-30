<?php
/**
 *  @package MochaForms
 */

 class Admin {
        
    public $settings;
    public $pages = array();
    public $subpages = array();

    public function __construct(){
        $this->settings = new SettingsApi();

        $this->pages = [
            ['page_title'=>'Mocha Forms', 
                'menu_title'=>'MochaForms', 
                'capability'=>'manage_options', 
                'menu_slug'=>'mocha_forms', 
                'callback'=> function(){ echo '<h1>MOCHAFORMS</h1>';}, 
                'icon_url'=>'dashicons-feedback', 
                'position'=>null]
        ];

        $this->subpages = array(
            
        ['parent_slug'=> 'mocha_forms',
                'page_title'=>'mf_designer', 
                'menu_title'=>'Form Designer', 
                'capability'=>'manage_options', 
                'menu_slug'=>'mf_design', 
                'callback'=>  function(){ echo '<h1>MF Designer</h1>';} 
        ],
        ['parent_slug'=> 'mocha_forms',
                'page_title'=>'mf_settings', 
                'menu_title'=>'Settings', 
                'capability'=>'manage_options', 
                'menu_slug'=>'mf_settings', 
                'callback'=>  function(){ echo '<h1>MF Settings</h1>';} 
        ],
        ['parent_slug'=> 'mocha_forms',
                'page_title'=>'mf_help', 
                'menu_title'=>'Help', 
                'capability'=>'manage_options', 
                'menu_slug'=>'mf_help', 
                'callback'=>  function(){ echo '<h1>MF Help Documentation</h1>';} 
                ]
        );
    }

    function admin_enqueue(){
        // enqueue scripts from assets
        wp_enqueue_style( 'mochaform_style', MF_PLUGINS_URL . '/assets/mf_admin_style.css' );
        wp_enqueue_script( 'mochaform_script', MF_PLUGINS_URL . '/assets/mf_admin_script.js' );
    }


    function menu_pages(){
        $this->settings->addPages($this->pages)->withSubpage('Dashboard')->addSubpages($this->subpages)->init();
    }

    // static function admin_index() { // Require templates
    //     require_once MF_PLUGIN_PATH . 'templates/admin.php';
    // }

    static function settings_link($links){
        $settings_link = '<a href="admin.php?page=mocha_forms">Settings</a>';
        array_push($links, $settings_link);
        return $links;
   }

 }

 