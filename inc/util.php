<?php
/**
 *  @package MochaForms
 */
namespace INC;

 class Util {

     public static function activate(){
        flush_rewrite_rules();
     }

     public static function deactivate(){
        flush_rewrite_rules();
     }
     
 }