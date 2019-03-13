<?php

/* ============================== Redirect function ========================= */
function redirect($page){
    header('location: ' . URL_ROOT . DIRECTORY_SEPARATOR . $page);
}

//