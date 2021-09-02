<?php
/**
 *  @package MochaForms
 */

 class Admin {
        
    public $settings;
    public $pages = array();
    public $subpages = array();
    public $MFT = MF_TEMPLATE_URL;
    public function __construct(){
        $this->settings = new SettingsApi();

        //echo "------------" . $this->MFT. "admin.php";

        $this->pages = [
            ['page_title'=>'Mocha Forms', 
                'menu_title'=>'MochaForms', 
                'capability'=>'manage_options', 
                'menu_slug'=>'mocha_forms', 
                'callback'=> function() { return require_once( $this->MFT . "admin.php"); }, 
                'icon_url'=>'dashicons-feedback', 
                'position'=>null]
        ];

        $this->subpages = array(
            
        ['parent_slug'=> 'mocha_forms',
                'page_title'=>'mf_designer', 
                'menu_title'=>'Form Designer', 
                'capability'=>'manage_options', 
                'menu_slug'=>'mf_design', 
                'callback'=>  function() { return require_once( $this->MFT . "designer.php"); }, 
        ],
        ['parent_slug'=> 'mocha_forms',
                'page_title'=>'mf_settings', 
                'menu_title'=>'Settings', 
                'capability'=>'manage_options', 
                'menu_slug'=>'mf_settings', 
                'callback'=> function() { return require_once( $this->MFT . "settings.php"); }, 
        ],
        ['parent_slug'=> 'mocha_forms',
                'page_title'=>'mf_help', 
                'menu_title'=>'Help', 
                'capability'=>'manage_options', 
                'menu_slug'=>'mf_help', 
                'callback'=>  function() { return require_once( $this->MFT . "help.php"); }, 
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

    static function settings_link($links){
        $settings_link = '<a href="admin.php?page=mocha_forms">Settings</a>';
        array_push($links, $settings_link);
        return $links;
   }

 }

 