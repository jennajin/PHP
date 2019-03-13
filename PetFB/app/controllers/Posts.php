<?php

class Posts extends Controller {

    public function __construct()
    {
        //if the user isn't logged in, the user redirect to the login pages
        //because just logged user must have access to the posts not guest.
        //isLoggedIn() : it defined in session helper instead of using this,
        //you can check the login status of the user with : !isset($_SESSION['user_id']);
        if(!(isLoggedIn())){
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');

    }

    /* ============================================= Posts page ============================================= */
    public function index(){
        //Get posts from db
        $posts = $this->postModel->getPosts();
        $data = [
            'posts'=> $posts
        ];

        $this->view('posts/index', $data);
    }

    /* ======================================== Call Add post model and view ===================================== */
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //filter the $_POST array which is sent by the form
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'picture' => trim($_POST['picture']),
                'body' => trim($_POST['body']),
                'userid' => $_SESSION['user_id'],
                'title_err' => '',
                'picture_err' => '',
                'body_err' => ''
            ];

            //validation of the form elements
            if (empty($data['title'])){
                $data['title_err'] = 'please enter title';
            }
            if (empty($data['body'])){
                $data['body_err'] = 'please enter body';
            }
            // picture
            if ($data['picture']) {
                $fileType = pathinfo($data['picture'], PATHINFO_EXTENSION);

                if (($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg")) {
                    $data['picture_err'] = "Only png, jpg and jepg files are allowed.";
                }
            }

            //check for existance of errors --
            // if there is not, title_err,body_err must be empty
            if(empty($data['title_err'])&& empty($data['picture_err']) && empty($data['body_err'])){
                if($this->postModel->addPost($data)){

                    if ($data['picture']) {
                        $this->pictureUpload($data);
                    }
                    messageBox('post_message','Post submitted.');
                    redirect('posts');
                }else{
                    die('there is an issue.');
                }
            }else{
                // load the view with errors
                $data['picture'] = null;
                $this->view('posts/add', $data);
            }
        }else{
            $data = [
                'title' => '',
                $data['picture'] = null,
                'body' => ''
            ];

            $this->view('posts/add', $data);
        }

    }

    /* ======================================== Call edit post model and view ===================================== */
    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //filter the $_POST array which is sent by the form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'picture' => trim($_POST['picture']),
                'body' => trim($_POST['body']),
                'userid' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //validation of the form elements
            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }

            // picture
            if ($data['picture']) {
                $fileType = pathinfo($data['picture'], PATHINFO_EXTENSION);

                if (($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg")) {
                    $data['picture_err'] = "Only png, jpg and jepg files are allowed.";
                }
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body text';
            }

            //check for existance of errors --
            // if there is not, title_err,body_err must be empty
            if(empty($data['title_err']) && empty($data['picture_err']) && empty($data['body_err'])){

                if($this->postModel->updatePost($data)){
                    $this->pictureUpload($data);
                    messageBox('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                if ($_POST->picture) {
                    $data['picture'] = $_POST->picture;
                } else {
                    $data['picture'] = null;
                }
                $this->view('posts/edit', $data);
            }

        } else {
            // Get existing post from model
            $post = $this->postModel->getPostById($id);

            // Check for the same user that is logged in to the website
            if($post->userId != $_SESSION['user_id']){
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'picture' => $post->picture,
                'body' => $post->body
            ];

            $this->view('posts/edit', $data);
        }
    }

    /* ======================================== Call delete post model and view ===================================== */
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Get existing post from model
            $post = $this->postModel->getPostById($id);

            // Check for the same user that is logged in to the website
            if($post->userId != $_SESSION['user_id']){
                redirect('posts');
            }

            if($this->postModel->deletePost($id)){
                messageBox('post_message', 'Post Deleted');
                redirect('posts');
            } else {
                die('there is an issue.');
            }
        } else {
            redirect('posts');
        }
    }

    /* ============================================= Upload a picture ==================================== */
    public function pictureUpload($data)
    {
        $target_path = getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'user' . $_SESSION['user_id']
            .DIRECTORY_SEPARATOR;

        if (!is_dir($target_path)) {
            mkdir($target_path);
        }

        $target_path = $target_path .'posts'. DIRECTORY_SEPARATOR;
        @$uploadFile = $_FILES["picture"]["tmp_name"];
        @$files = scandir($target_path);

        // create a directory
        if (!is_dir($target_path)) {
            mkdir($target_path);
        }

        if ($_FILES["picture"]["size"]) {
            move_uploaded_file($uploadFile, $target_path . $_FILES["picture"]["name"]);
            return true;
        }
        return false;
    }


    /* ======================================== Call show post view ===================================== */
    // remember that the address divided by three parts
    //1. controller - e.g : posts
    //2. method - e.g : show
    //3. parameters : 1/2/3/4/5/6
    // example : posts/show/1
    public function show($id){

        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->userId);

        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show',$data);
    }
}