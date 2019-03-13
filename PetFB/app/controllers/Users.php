<?php
class Users extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    /* ============================================= Registration ======================================= */
    public function register()
    {
        // check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // filter POST data
            /*
             * The filter_input_array() function gets external variables
             * (e.g. from form input) and optionally filters them.
             *      filter_input_array(type, definition, add_empty)
             * type	Required. The input type to check for. Can be one of the following:
                    INPUT_GET
                    INPUT_POST
                    INPUT_COOKIE
                    INPUT_SERVER
                    INPUT_ENV
             *
             * The FILTER_SANITIZE_STRING filter removes tags and
               remove or encode special characters from a string.

            Possible options and flags:
                FILTER_FLAG_NO_ENCODE_QUOTES - Do not encode quotes
                FILTER_FLAG_STRIP_LOW - Remove characters with ASCII value < 32
                FILTER_FLAG_STRIP_HIGH - Remove characters with ASCII value > 127
                FILTER_FLAG_ENCODE_LOW - Encode characters with ASCII value < 32
                FILTER_FLAG_ENCODE_HIGH - Encode characters with ASCII value > 127
                FILTER_FLAG_ENCODE_AMP - Encode the "&" character to &amp;
            */

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //Initial data
            $data = [
                'userName' => trim($_POST['userName']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'provinceLists' => $this->userModel->getProvinces(),
                'provinceId' => trim($_POST['provinceId']),
                'cityLists' => $this->userModel->getCities($_POST['provinceId']),
                'cityId' => trim($_POST['cityId']),
                'userType' => 1,
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'phone_err' => '',
                'address_err' => ''
            ];

            //validation
            $validation_check = false;
            if (isset($_POST['register'])) {
                //userName:
                if (empty($data['userName'])) {
                    $data['name_err'] = 'Please enter name';
                }

                //email:
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please Enter email';
                } elseif ($this->userModel->findUserByEmail($data['email'])) {
                    //check email for existence
                    $data['email_err'] = 'Email is already taken';
                }

                //password :
                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must have minimum 6 characters ';
                }

                //confirm password :
                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please enter confirm password';
                }
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Password does not match the confirm password';
                }

                //phone :
                if ($data['phone'] == null) {
                    $data['phone_err'] = 'Please enter your phone number';
                } elseif (!is_numeric($data['phone']) || strlen((string)$data['phone']) < 10 || preg_match_all('/\.|\+|\-/', $data['phone'])) {
                    $data['phone_err'] = 'Please enter a valid 10 digit phone number';
                }

                if(!$data['name_err'] && !$data['email_err'] && !$data['password_err'] &&  !$data['confirm_password_err'] && !$data['phone_err']){
                    $validation_check = true;
                }
            }

            //check if there is not any error
            if ($validation_check) {

                //encryption of password
                //password_hash — Creates a password hash
                /*     PASSWORD_DEFAULT (integer)
                           The default algorithm to use for hashing if no algorithm is provided.
                           This may change in newer PHP releases when newer, stronger hashing
                           algorithms are supported.
                */
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // register user
                // check everything is ok?
                if ($this->userModel->register($data)) {
                    messageBox('register_success', 'registration is completed. You can log in now!');
                    redirect('users/login');
                } else {
                    die('ERROR! - registration is failed');
                }
            } else {
                //load the view with errors
                $this->view('users/register', $data);
            }
        }else {
            //Initial data
            $data=[
                'userName' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'phone' => '',
                'address' => '',
                'provinceLists' => $this->userModel->getProvinces(),
                'provinceId' => '',
                'cityLists' => $this->userModel->getCities('provinceId'),
                'cityId' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'phone_err' => '',
                'address_err' => ''
            ];

            //load view
            $this->view('users/register',$data);
        }
    }

    /* ============================================= Login ============================================== */
    public function login(){
        // check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process form

            // filter POST data
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            //Initial data
            $data=[
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
           ];

            //validation
            $validation_check=false;
            //email :
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            } elseif(!$this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'No such a user';
            }

            //password :
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            // check if there is not any error
            if(empty($data['email_err']) && empty($data['password_err']) ){
                //check and set login user
                //$loggedInUser will fill either by $row from model or false(if there is not any match password
                $loggedInUser = $this->userModel->login($data['email'],$data['password']);

                if($loggedInUser){
                    //create session
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_err'] = "The password is incorrect";
                    $this->view('users/login',$data);
                }
            } else{
                //load the view with errors
                $this->view('users/login',$data);
            }

        }else {
            //Initial data
            $data=[
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            //load view
            $this->view('users/login',$data);
        }
    }

    /* ============================================= My Account ========================================= */
    public function controlpanel(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // get user information by Id
        $userInfo = $this->userModel->getUserById($_SESSION['user_id']);
        $data = [
            'userName' => $userInfo->userName,
            'email' => $userInfo->email,
            'password' => '',
            'confirm_password' => '',
            'phone' => $userInfo->phone,
            'address' => $userInfo->address,
            'provinceLists' => $this->userModel->getProvinces(),
            'provinceId' =>$userInfo->provinceId,
            'cityLists' => $this->userModel->getCities($userInfo->provinceId),
            'cityId' => $userInfo->cityId,
            'name_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'phone_err' => '',
            'address_err' => ''
        ];

        // edit user information
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Initial data
            $data = [
                'userName' => trim($_POST['userName']),
                'email' => $userInfo->email,
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'provinceLists' => $this->userModel->getProvinces(),
                'provinceId' => trim($_POST['provinceId']),
                'cityLists' => $this->userModel->getCities($_POST['provinceId']),
                'cityId' => trim($_POST['cityId']),
                'name_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'phone_err' => '',
                'address_err' => ''
            ];

            //validation
            $validation_check = false;
            if (isset($_POST['edit'])) {
                //userName:
                if (empty($data['userName'])) {
                    $data['name_err'] = 'Please enter your name';
                }

                //password :
                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must have minimum 6 characters ';
                }

                //confirm password :
                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please enter confirm password';
                }
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Password does not match the confirm password';
                }

                //phone :
                if ($data['phone'] == null) {
                    $data['phone_err'] = 'Please enter your phone number';
                } elseif (!is_numeric($data['phone']) || strlen((string)$data['phone']) < 10 || preg_match_all('/\.|\+|\-/', $data['phone'])) {
                    $data['phone_err'] = 'Please enter a valid 10 digit phone number';
                }

                //if there is no error
                if(!$data['name_err'] && !$data['password_err'] &&  !$data['confirm_password_err'] && !$data['phone_err']){
                    $validation_check = true;
                }
            }

            //check if there is not any error
            if ($validation_check) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // edit user information
                if ($this->userModel->editUserInfo($data)) {
                    $_SESSION['user_name']=$data['userName'];
                    messageBox('edit_success', ' is completed');
                    redirect('posts');
                } else {
                    die('ERROR! - Edition is failed');
                }
            }
        }
        $this->view('users/controlpanel',$data);
    }

    /* ============================================= Sessions =========================================== */
    public function createUserSession($user){
        //$user is $row which is retrieve from database in User model - consist of every information for users
        $_SESSION['user_id'] = $user->userId;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->userName;
        $_SESSION['user_type'] = $user->userType;

        //because the index is a default pages for everything in the website
        //we don't need to write "redirect('posts/index');"
        //you just need to write this : "redirect('posts');"
        redirect('posts');
    }

    /* ============================================= Logout ============================================= */
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_type']);
        session_destroy();
        redirect('users/login');
    }

}
