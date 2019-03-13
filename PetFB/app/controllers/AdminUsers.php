<?php

class AdminUsers extends Controller
{
 
   public function __construct()
    {
      if(!(isLoggedIn())){

          redirect('users/login');
      }

   $this->adminuserModel = $this->model('AdminUser');
   $this->admincatModel = $this->model('AdminCat');

    }

   public function index(){
   //Get users from db
    $users = $this->adminuserModel->getUsers();
    $data = [
     'users'=> $users
    ];
   $this->view('adminusers/index', $data);
 }

//Edit user
    public function edit($id){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // get user information by Id
        $userInfo = $this->adminuserModel->getUserById($id);
        $data = [
            'userId'=>$userInfo->userId,
            'userName' => $userInfo->userName,
            'email' => $userInfo->email,
            'password' => '',
            'confirm_password' => '',
            'phone' => $userInfo->phone,
            'address' => $userInfo->address,
            'provinceLists' => $this->adminuserModel->getProvinces(),
            'provinceId' =>$userInfo->provinceId,
            'cityLists' => $this->adminuserModel->getCities($userInfo->provinceId),
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
                'userId' => $id,
                'userName' => trim($_POST['userName']),
                'email' => $userInfo->email,
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'provinceLists' => $this->adminuserModel->getProvinces(),
                'provinceId' => trim($_POST['provinceId']),
                'cityLists' => $this->adminuserModel->getCities($_POST['provinceId']),
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
          //  if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
                if (empty($data['phone'])) {
                    $data['phone_err'] = 'Please enter your phone number';
                } elseif (!is_numeric($data['phone']) || strlen((string)$data['phone']) < 10) {
                    $data['phone_err'] = 'Please enter a valid 10 digit phone number';
                }

                if(!$data['name_err'] && !$data['password_err'] &&  !$data['confirm_password_err'] && !$data['phone_err']){
                    $validation_check = true;
                }
            }

            //check if there is not any error
            if ($validation_check) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // edit user information
                if ($this->adminuserModel->editUser($data)) {

                    messageBox('admuser_message', ' User updated');
                    redirect('adminusers');
                } else {
                    die('There is an issue');
                }
            }
        }
        $this->view('adminusers/edit',$data);
    }


    //----------------Delete User------------
    //Delete user
    public function delete($id){
  
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

          // Get existing user from model
         $user = $this->adminuserModel->getUserById($id);
         $cat=$this->admincatModel->getCatByUserId($id);
         if($this->adminuserModel->deleteUser($id)&&($this->admincatModel->deleteCat($id))){

       messageBox('admuser_message', 'User Deleted');
       redirect('adminusers');
         }else {
            die('there is an issue.');
         }
    }
    else {
       redirect('posts');
    }
   }

public function show(){
//assign id from search bar to $id
    if(isset($_POST['search'])){
        $id=$_POST['search'];

       $user = $this->adminuserModel->getUserById($id);
       $cat = $this->admincatModel->getCatByUserId($user->userId);

        $data = [
            'user' => $user,
            'cat' => $cat
        ];
        $this->view('adminusers/show', $data);
    }
  }
}