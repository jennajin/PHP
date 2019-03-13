<?php
/**
 * Created by PhpStorm.
 * User: mazmac
 * Date: 12/12/17
 * Time: 22:39
 */

   // load Config file
    require_once 'config/config.php';
   // load Helper file
    require_once 'helpers/urlhelper.php';
    require_once 'helpers/sessionhelper.php';



    // Autoload all Libraries

    //spl_autoload_register() -  Register given function(here: anonymousfunction)
    // as __autoload() implementation
    spl_autoload_register(function ($className){
        require_once 'libraries/'. $className .'.php';
   });