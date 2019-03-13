<?php

class AdminUser
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUsers()
    {
        $this->db->query('SELECT *,
        users.userId as userId,
        users.userName as userName,
        cats.catName as catName
        FROM users
        LEFT  JOIN  cats
        ON users.userId = cats.userId
        ORDER By users.userId ASC ');

        $results = $this->db->resultSet();
        return $results;

    }

    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM users WHERE userId = :userId');
        $this->db->bind(':userId', $id);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE userId = :userId');
        $this->db->bind(':userId', $id);
        $row = $this->db->single();

        return $row;
    }

// get provinces
    public function getProvinces(){
        $this->db->query('SELECT * FROM provinces');
        $results = $this->db->resultSet();
        return $results;
        }

    // get cities
    public function getCities($provinceId){
        $this->db->query("SELECT * FROM cities WHERE provinceId = :provinceId");
        $this->db->bind(':provinceId', $provinceId);
        $results = $this->db->resultSet();
        return $results;
    }


    public function editUser($data){
        $this->db->query('UPDATE users SET userName=:userName,password=:password,phone=:phone,address=:address,
                                                  provinceId=:provinceId,cityId=:cityId
                              WHERE userId=:userId');

        $this->db->bind(':userName', $data['userName']);
        $this->db->bind(':password',$data['password']);
        $this->db->bind(':phone',$data['phone']);
        $this->db->bind(':address',$data['address']);
        $this->db->bind(':provinceId',$data['provinceId']);
        $this->db->bind(':cityId',$data['cityId']);
        $this->db->bind(':userId',$data['userId']);

        if($this->db->execute()){
            return true;
        }
        return false;
    }
}