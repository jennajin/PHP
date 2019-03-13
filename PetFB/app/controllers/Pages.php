<?php

class Pages extends Controller {

    public function __construct(){


    }

    /* ================================ Call index view from pages(default page) ================================== */
    // because the default controller is Pages and the default method is index
    //must provide the index method
    public function index(){
        if(isLoggedIn()){
            redirect('posts');
        }
        $data = [
            'title' => 'PetFB',
            'description' => 'The First Pet Social Network'
       ];

       $this->view('pages/index', $data);
    }
    /* ======================================== Call about view from pages ===================================== */
    public function about(){
        $data = [
            'title' => 'About Us',
            'description' => '<br/> Programmers and Designers : <ul><li>Natalia Doudkina</li> <li>Jin Jeongah </li> <li> Maziar Modarresi </li></ul> '
        ];
        $this->view('pages/about',$data);
    }
}