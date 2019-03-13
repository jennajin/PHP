<?php

class AdminCat
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function getCats()
    {
        $this->db->query('SELECT *,
        users.userId as userId,
        users.userName as userName,
        cats.catName as catName
        FROM users
        INNER JOIN  cats
        ON users.userId = cats.userId
        ORDER By users.userId ASC ');

        $results = $this->db->resultSet();
        return $results;

    }

    public function getCatById($id)
    {
        $this->db->query('SELECT * FROM cats WHERE catId = :catId');
        $this->db->bind(':catId', $id);
        $row = $this->db->single();
        return $row;
    }

    public function getCatByUserId($id)
    {
        $this->db->query('SELECT * FROM cats WHERE userId = :userId');
        $this->db->bind(':userId', $id);
        $row = $this->db->single();
        return $row;

    }

    public function getCatByName($catName)
    {
        $this->db->query('SELECT * FROM cats WHERE catName = :catName');
        $this->db->bind(':catName', $catName);
        $row = $this->db->single();
        return $row;
    }

    public function updateCat($data)
    {
        $this->db->query('UPDATE cats SET catName=:catName,age=:age,genderId=:genderId,
                                                breedId=:breedId,colorId=:colorId,picture=:picture,
                                                marital=:marital,spouseId=:spouseId
                              WHERE catId=:catId');

        $this->db->bind(':catName', $data['catName']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':genderId', $data['genderId']);
        $this->db->bind(':breedId', $data['breedId']);
        $this->db->bind(':colorId', $data['colorId']);
        $this->db->bind(':marital', $data['marital']);
        $this->db->bind(':spouseId', $data['spouseId']);
        $this->db->bind(':picture', $data['picture']);
        $this->db->bind(':catId', $data['catId']);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function deleteCat($id)
    {
        $this->db->query('DELETE FROM cats WHERE userId = :userId');
        $this->db->bind(':userId', $id);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }
}