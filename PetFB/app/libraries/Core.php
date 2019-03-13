<?php
/**
 * Created by PhpStorm.
 * User: mazmac
 * Date: 12/12/17
 * Time: 22:32
 */

/*
 *  Name : Core Class
 *  Creates url and loads core controller
 *  Format :  /controller/method/params - e.g : /post/add/1
 */

class Core
{
    /* when there's not any specific controller in url,
    * the default will be pages
    */
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
      //  print_r($this -> getUrl());

        // call the getUrl method to retrieve  a queryString from AddressBar
        $url = $this -> getUrl();

        //============================= First part of url - "name of the controller" =========================

        // check the controllers folder for existence of the file
        // which is mentioned in first value of the $url array
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){

            //if exists, set this controller as a current controller
            // - default is "Pages"
            $this->currentController = ucwords($url[0]);

            // unset index 0 because we took it and assign
            // it to the currentController
            unset($url[0]);
        }

        // require the controller - e.g : whatever is in $url[0] or
        // currentController must be added
        require_once '../app/controllers/'. $this->currentController .'.php';

        // create an object from the specific page that it is chosen now -
        // e.g $post = new Post();
        $this->currentController = new $this->currentController;

        //============================= Second part of url - "name of the method" =============================
        if (isset($url[1])){

            //check existence of method in the controller
            if (method_exists($this->currentController,$url[1])){
                $this->currentMethod = $url[1];

                //unset 1 index
                unset($url[1]);
            }
        }
       // =============================  other parts of url - " these are parameters " =========================

       //array_values() returns all the values from the array
       // and indexes the array numerically.
        $this->params = $url ? array_values($url) : [];

        //call_user_func_array — Call a callback with an array of parameters
        /*  class foo {
             function bar($arg, $arg2) {
             echo __METHOD__, " got $arg and $arg2\n";
               }
            }
             // Call the $foo->bar() method with 2 arguments
            $foo = new foo;
            call_user_func_array(array($foo, "bar"), array("three", "four"));

                     output : foo::bar got three and four
        */
        call_user_func_array([$this->currentController,$this->currentMethod], $this->params);
    }

    /* ================================= Get url from address bar ============================== */
    public function getUrl(){

       if (isset($_GET['url'])){

        // if there is a slash at the end of url in
        // queryString, it will be deleted
        $url = rtrim($_GET['url'],'/');

        //Remove all characters except letters, digits
        // and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
        $url = filter_var($url,FILTER_SANITIZE_URL);

        //explode the utr string to an array
        // e.g : "className/methodName/id" => an array(className,methodName,id)
        $url = explode('/',$url);

        return $url;
       }

    }

}