<?php
/*
 * This is the base Controller
 * It will load the all models and views
 */

class Controller {

    /* ================================= Load models ============================== */
     public function model($model){
        // require model file
        require_once '../app/models/' . $model . '.php';

        //instantiat the model

        return new $model();
    }


    /* ================================= Load views ============================== */
    public function view($view,$data = [])
    {

        //check existance of file
        if (file_exists('../app/views/' . $view . '.php')) {


            // require view file
            require_once '../app/views/' . $view . '.php';
        } else {
            // view doesn't exist
            die('view doesn\'t exist');
        }
    }
}