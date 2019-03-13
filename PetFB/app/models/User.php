<?php

class User{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    /* ============================================= Registration ======================================= */
    public function register($data){
        $this->db->query('INSERT INTO users(userName,email,password,phone,address,provinceId,cityId,userType) 
                              VALUES(:userName,:email,:password,:phone,:address,:provinceId,:cityId,:userType)');

        $this->db->bind(':userName',$data['userName']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);
        $this->db->bind(':phone',$data['phone']);
        $this->db->bind(':address',$data['address']);
        $this->db->bind(':provinceId',$data['provinceId']);
        $this->db->bind(':cityId',$data['cityId']);
        $this->db->bind(':userType',$data['userType']);

        // for INSERT,UPDATE,DELETE USE execute
        // check if everything is ok return true.Otherwise, return false
        if($this->db->execute()){
            return true;
        }
        return false;
    }

    /* ============================================= Login ============================================== */
    public function login($email,$password){
        $this->db->query('SELECT * FROM users WHERE email = :email');

        $this->db->bind(':email',$email);

        $row = $this->db->single();

        $hashed_password = $row->password;

        if(password_verify($password,$hashed_password)){
            return $row;
        }
        return false;
    }

    // get user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');

        $this->db->bind(':email',$email);

        $row = $this->db->single();

        if($this->db->rowCount()>0){
            return true;
        }
        return false;
    }

    /* ============================================= My account ========================================= */
    // get user info
    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE userId = :userId');
        $this->db->bind(':userId', $id);
        $row = $this->db->single();
        return $row;
    }

    // Update user information
    public function editUserInfo($data){
        $this->db->query('UPDATE users SET userName=:userName,password=:password,phone=:phone,address=:address,
                                                  provinceId=:provinceId,cityId=:cityId
                              WHERE userId=:userId');

        $this->db->bind(':userName',$data['userName']);
        $this->db->bind(':password',$data['password']);
        $this->db->bind(':phone',$data['phone']);
        $this->db->bind(':address',$data['address']);
        $this->db->bind(':provinceId',$data['provinceId']);
        $this->db->bind(':cityId',$data['cityId']);
        $this->db->bind(':userId',$_SESSION['user_id']);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    /* ============================================= Get drop-box information =========================== */
    // get PROVINCES from USERS table
    public function getProvinces(){
        $this->db->query('SELECT * FROM provinces');
        $results = $this->db->resultSet();
        return $results;
    }

    // get CITIES from USERS table
    public function getCities($provinceId){
        $this->db->query('SELECT * FROM cities WHERE provinceId = :provinceId');
        $this->db->bind(':provinceId', $provinceId);
        $results = $this->db->resultSet();
        return $results;
    }
}

?>