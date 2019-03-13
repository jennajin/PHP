<?php

session_start();

/* ================================= MessageBox helper ============================== */
//e.g : messageBox('login_success','welcome to your account','alert alert-success');
//showing message in the view format: echo messageBox('login_success');
function messageBox($name='',$message='',$class='alert alert-success'){
   if(!empty($name)){
       if(!empty($message) && empty($_SESSION[$name])){

           if(!empty($_SESSION[$name])){
               unset($_SESSION[$name]);
           }

           if(!empty($_SESSION[$name . '_class'])){
               unset($_SESSION[$name . '_class']);
           }
           $_SESSION[$name] = $message;
           $_SESSION[$name . '_class'] = $class;

       }elseif(empty($message) && !empty($_SESSION[$name])){
         $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
        echo '<div class="' . $class . '" id="msg-messageBox">'. $_SESSION[$name].'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
       }
   }
}

/* ====================== Check whether or not the user logged in. ====================== */
//
function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    }
    return false;
}