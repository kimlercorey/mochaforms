<?php
/**
 *  @package MochaForms
 */

 class Util {

     public static function activate(){
        flush_rewrite_rules();
     }

     public static function deactivate(){
        flush_rewrite_rules();
     }
     
     static function autoload($path='inc'){
      $dir = new RecursiveDirectoryIterator(MF_PLUGIN_PATH . $path);
      foreach ( new RecursiveIteratorIterator($dir) as $file) {
          if (!is_dir($file)) {
              if( fnmatch('*.class.php', $file) ) 
                  require_once $file;
          }
      }
  }
 }