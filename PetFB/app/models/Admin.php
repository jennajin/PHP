<?php
/**
 * Created by PhpStorm.
 * User: zvere
 * Date: 2017-12-23
 * Time: 9:43 PM
 */

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getGenders()
    {

        $this->db->query('select *from genders');
        $results = $this->db->resultSet();
        return $results;
    }

    public function addGender($data)
    {

        $this->db->query('INSERT INTO genders (gender) VALUES(:gender)');

        $this->db->bind(':gender', $data['gender']);


        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function getGenderById($id)
    {
        $this->db->query('SELECT gender FROM genders WHERE genderId=:id');
        $row = $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function editGender($data)
    {

        $this->db->query('UPDATE genders SET gender = :gender WHERE genderId=:genderId');


        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':genderId', $data['genderId']);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }


    public function deleteGender($id)
    {
        $this->db->query('DELETE FROM genders WHERE genderId = :genderId');
        $this->db->bind(':genderId', $id);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }


    //---------------------------------Colors
    public function getColors()
    {
        $this->db->query('SELECT * FROM colors');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getColorById($id)
    {
        $this->db->query('SELECT * FROM colors WHERE colorId=:colorId');
        $row = $this->db->bind(':colorId', $id);
        $row = $this->db->single();
        return $row;
    }

    public function addColor($data)
    {

        $this->db->query('INSERT INTO colors (color) VALUES(:color)');
        $this->db->bind(':color', $data['color']);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function editColor($data)
    {

        $this->db->query('UPDATE colors SET color = :color WHERE colorId=:colorId');


        $this->db->bind(':color', $data['color']);
        $this->db->bind(':colorId', $data['colorId']);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function deleteColor($id)
    {

        $this->db->query('DELETE FROM colors WHERE colorId = :colorId');
        $this->db->bind(':colorId', $id);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

//---------------------Breeds-------------

    public function getBreeds()
    {
        $this->db->query('SELECT * FROM breeds');
        $results = $this->db->resultSet();
        return $results;
    }


    public function getBreedById($id)
    {
        $this->db->query('SELECT * FROM breeds WHERE breedId=:breedId');
        $row = $this->db->bind(':breedId', $id);
        $row = $this->db->single();
        return $row;
    }

    public function addBreed($data)
    {

        $this->db->query('INSERT INTO breeds (breed) VALUES(:breed)');
        $this->db->bind(':breed', $data['breed']);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function deleteBreed($id)
    {

        $this->db->query('DELETE FROM breeds WHERE breedId = :breedId');
        $this->db->bind(':breedId', $id);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function editBreed($data)
    {
        $this->db->query('UPDATE breeds SET breed = :breed WHERE breedId=:breedId');
        $this->db->bind(':breed', $data['breed']);
        $this->db->bind(':breedId', $data['breedId']);
        if ($this->db->execute()) {
            return true;
        }
        return false;

    }

    //-----------Cities----------
    public function getCities()
    {
        $this->db->query("SELECT * FROM cities");

        $results = $this->db->resultSet();
        return $results;
    }

    public function getCityById($id)
    {
        $this->db->query('SELECT * FROM cities WHERE cityId=:cityId');
        $row = $this->db->bind(':cityId', $id);
        $row = $this->db->single();
        return $row;
    }

    public function addCity($data)
    {

        $this->db->query('INSERT INTO cities (city, provinceId) VALUES(:city,:provinceId)');
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':provinceId', $data['provinceId']);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }


    public function editCity($data)
    {
        $this->db->query('UPDATE cities SET city = :city, provinceId=:provinceId WHERE cityId=:cityId');
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':cityId', $data['cityId']);
        $this->db->bind(':provinceId', $data['provinceId']);
        if ($this->db->execute()) {
            return true;
        }
        return false;

    }

    public function deleteCity($id)
    {

        $this->db->query('DELETE FROM cities WHERE cityId = :cityId');
        $this->db->bind(':cityId', $id);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    //-----------Provinces----------
    public function getProvinces()
    {
        $this->db->query('SELECT * FROM provinces');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getProvinceById($id)
    {
        $this->db->query('SELECT * FROM provinces WHERE provinceId=:provinceId');
        $row = $this->db->bind(':provinceId', $id);
        $row = $this->db->single();
        return $row;
    }

    public function addProvince($data)
    {

        $this->db->query('INSERT INTO provinces (province, provinceId) VALUES(:province,:provinceId)');
        $this->db->bind(':province', $data['province']);
        $row = $this->db->bind(':provinceId', $data['provinceId']);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function editProvince($data)
    {
        $this->db->query('UPDATE provinces SET province = :province WHERE provinceId=:provinceId');
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':provinceId', $data['provinceId']);
        if ($this->db->execute()) {
            return true;
        }
        return false;

    }

    public function deleteProvince($id)
    {

        $this->db->query('DELETE FROM provinces WHERE provinceId = :provinceId');
        $this->db->bind(':provinceId', $id);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    }