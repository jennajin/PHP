<?php


    // DataBase parameters
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASSWORD','mysql');
    define('DB_NAME','f7team1_petfb');

    //App root
    //dirname() returns parent folder of file
    //e.g :
    // this is the address of file /home/f7team1/public_html/docs/petfb/app/config/config.php
    // this is parent forlder of file /home/f7team1/public_html/docs/petfb/app/config
    // we need one more step back /home/f7team1/public_html/docs/petfb/app
     define('APPLICATION_ROOT',dirname(dirname(__FILE__)));

    //URL Root
    define('URL_ROOT','/docs/petfb');

    //Site Name
    define('SITE_NAME','PetFB');

    //App Version
    define('APP_VERSION','2.1');