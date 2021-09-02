<?php
/**
 *  @package MochaForms
 */

 class SettingsApi {
  
    public $admin_pages = array();
    public $admin_subpages = array();

    function __construct() {
        //$this->init();
    }

    function init(){
        
        if ( ! empty($this->admin_pages)){
            $this->addAdminMenu();
        }
    }

    function callbacks(){
        echo "HELO";
    }

    function addAdminMenu(){
        foreach ($this->admin_pages as $page){
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }

        foreach ($this->admin_subpages as $page){
            add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback']);
        }
    }

    function withSubPage(string $title = null){
        //echo "------------------------------".$title;
        if (empty($this->admin_pages)) return $this; 

        $admin_page = $this->admin_pages[0];
            
        $subpages = array(
            ['parent_slug'=> $admin_page['menu_slug'],
            'page_title'=>$admin_page['page_title'], 
            'menu_title'=> ($title) ? $title : 'General' , //$admin_page['menu_title'], 
            'capability'=>$admin_page['capability'], 
            'menu_slug'=>$admin_page['menu_slug'], 
            'callback'=> $admin_page['callback'] 
            ]
        );

        $this->admin_subpages = $subpages;

        return $this;
    }

    public function addPages(array $pages){
        
        $this->admin_pages = $pages;

        return $this;
    }

    public function addSubpages(array $pages){
        
        $this->admin_subpages = array_merge( $this->admin_subpages, $pages);

        return $this;
    }


 }