<?php

class Cat{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    /* ============================================= My cat ============================================= */
    // Get cat information
    public function getCatByUserId($userId){
        $this->db->query('SELECT * FROM cats WHERE userId=:userId');
        $this->db->bind(':userId', $userId);
        $row = $this->db->single();

        if($row){
            return $row;
        }
        return false;
    }

    // Get cat's gender
    public function getGenderInfo($genderId){
        $this->db->query('SELECT gender FROM genders WHERE genderId=:genderId');
        $this->db->bind(':genderId', $genderId);
        $row = $this->db->single();
        if($row){
            return $row;
        }
        return false;
    }

    // Get cat's breed
    public function getBreedInfo($breedId){
        $this->db->query('SELECT breed FROM breeds WHERE breedId=:breedId');
        $this->db->bind(':breedId', $breedId);
        $row = $this->db->single();
        if($row){
            return $row;
        }
        return false;
    }

    // Get cat's color
    public function getColorInfo($colorId){
        $this->db->query('SELECT color FROM colors WHERE colorId=:colorId');
        $this->db->bind(':colorId', $colorId);
        $row = $this->db->single();
        if($row){
            return $row;
        }
        return false;
    }

    // Get cat's spouse
    public function getSpouseInfo($spouseId){
        $this->db->query('SELECT * FROM cats WHERE catId=:spouseId');
        $this->db->bind(':spouseId', $spouseId);
        $row = $this->db->single();
        if($row){
            return $row;
        }
        return false;
    }

    /* ============================================= Add my cat ========================================= */
    public function addCatInfo($data){
        $this->db->query('INSERT INTO cats(catName,age,genderId,breedId,colorId,picture,marital,spouseId,userId) 
                              VALUES(:catName,:age,:genderId,:breedId,:colorId,:picture,1,0,:userId)');

        $this->db->bind(':catName',$data['catName']);
        $this->db->bind(':age',$data['age']);
        $this->db->bind(':genderId',$data['genderId']);
        $this->db->bind(':breedId',$data['breedId']);
        $this->db->bind(':colorId',$data['colorId']);
        $this->db->bind(':picture',$data['picture']);
        $this->db->bind(':userId',$_SESSION['user_id']);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    /* ============================================= Edit my cat ======================================== */
    public function editCatInfo($data){
        $this->db->query('UPDATE cats SET catName=:catName,age=:age,genderId=:genderId,
                                                breedId=:breedId,colorId=:colorId,picture=:picture,
                                                marital=:marital,spouseId=:spouseId
                              WHERE catId=:catId');

        $this->db->bind(':catName',$data['catName']);
        $this->db->bind(':age',$data['age']);
        $this->db->bind(':genderId',$data['genderId']);
        $this->db->bind(':breedId',$data['breedId']);
        $this->db->bind(':colorId',$data['colorId']);
        $this->db->bind(':marital',$data['marital']);
        $this->db->bind(':spouseId',$data['spouseId']);
        $this->db->bind(':picture',$data['picture']);
        $this->db->bind(':catId',$data['catId']);

        if($this->db->execute() && $this->updateSpouse($data)){
            return true;
        }
        return false;
    }

    /* ============================================= Delete my cat ====================================== */
    public function deleteCatInfo($data){
        // Reset spouse Id
        if(isset($data->spouseId)){
            $this->resetSpouse($data->spouseId);
        }

        // Delete img folder
        $target_path = getcwd().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'user'.$_SESSION['user_id'].DIRECTORY_SEPARATOR;
        $files=scandir($target_path);
        if(is_dir($target_path)){
            foreach($files as $f){
                if( $f[0]=="."){
                    //don't display current dir
                    continue;
                }
                unlink($target_path.$f);
            }
          //  rmdir($target_path);
        }

        // Delete cat's information from database
        $this->db->query('DELETE FROM cats WHERE userId=:userId');
        $this->db->bind(':userId',$_SESSION['user_id']);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    /* ============================================= Update spouse information ========================== */
    // Update a new spouse information
    public function updateSpouse($data){
        if($data['spouseId']){
            $this->db->query('UPDATE cats SET marital=2,spouseId=:catId WHERE catId=:spouseId');
            $this->db->bind(':catId',$data['catId']);
            $this->db->bind(':spouseId',$data['spouseId']);

        }

        if($this->db->execute() && $this->updatePreviousSpouse($data['spouseId'], $data['catId'])){
            return true;
        }

        return false;
    }

    // Update previous spouse information
    public function updatePreviousSpouse($spouseId, $catId){
        $this->db->query('UPDATE cats SET marital=1,spouseId=0 WHERE catId<>:spouseId AND spouseId=:catId');
        $this->db->bind(':spouseId',$spouseId);
        $this->db->bind(':catId',$catId);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    // Reset spouse information
    public function resetSpouse($spouseId){
        $this->db->query('UPDATE cats SET marital=1,spouseId=0 WHERE catId=:spouseId');
        $this->db->bind(':spouseId',$spouseId);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    /* ============================================= Get drop-box information =========================== */
    // get GENDERS from CATS table
    public function getGenders(){
        $this->db->query('SELECT * FROM genders');
        $results = $this->db->resultSet();
        return $results;
    }

    // get BREEDS from CATS table
    public function getBreeds(){
        $this->db->query('SELECT * FROM breeds ORDER BY breed');
        $results = $this->db->resultSet();
        return $results;
    }

    // get COLORS from CATS table
    public function getColors(){
        $this->db->query('SELECT * FROM colors ORDER BY color');
        $results = $this->db->resultSet();
        return $results;
    }

    // get CATID from CATS table (spouse)
    public function getSpouses($data){
        $this->db->query('SELECT * FROM cats WHERE catId<>:catId AND genderId<>:genderId AND ((marital IS NULL OR marital=1) OR catId=:spouseId)');

        $this->db->bind(':catId', $data->catId);
        $this->db->bind(':genderId', $data->genderId);
        $this->db->bind(':spouseId', $data->spouseId);
        $results = $this->db->resultSet();
        return $results;
    }

    // get all CATID from CATS table (all spouse)
    public function getAllCats(){
        $this->db->query('SELECT * FROM cats WHERE marital IS NULL OR marital=1');
        $results = $this->db->resultSet();
        return $results;
    }

    /* ============================================= search ============================================= */
    // Search by user selection
    public function searchResult($data){
        $this->db->query('SELECT cats.catId, cats.catName, cats.age, cats.userId, cats.picture, cats.marital, cats.spouseId,
                                      genders.gender, breeds.breed, colors.color, province, city FROM cats 
                                INNER JOIN genders ON cats.genderId=genders.genderId
                                INNER JOIN breeds ON cats.breedId=breeds.breedId
                                INNER JOIN colors ON cats.colorId=colors.colorId
                                LEFT JOIN (SELECT provinces.provinceId, provinces.province, cities.cityId, cities.city, users.userId FROM users 
                                              INNER JOIN provinces ON users.provinceId=provinces.provinceId
                                              INNER JOIN cities ON users.cityId=cities.cityId) 
                                              AS user1 ON cats.userId=user1.userId
                                WHERE IF(:genderId<>0, genders.genderId=:genderId, 1)
                                       AND IF(:breedId<>0 , breeds.breedId=:breedId, 1)
                                       AND IF(:colorId<>0, colors.colorId=:colorId, 1)
                                       AND IF(:ageFrom<>0 AND :ageTo<>0, cats.age>=:ageFrom AND cats.age<=:ageTo, 1)
                                       AND IF(:provinceId<>0, provinceId=:provinceId, 1)
               	                       AND IF(:cityId<>0, cityId=:cityId, 1)
               	                       AND IF(:marital<>0, marital=:marital, 1)
                                GROUP BY cats.catId');

        $this->db->bind(':genderId', $data['genderId']);
        $this->db->bind(':breedId', $data['breedId']);
        $this->db->bind(':colorId', $data['colorId']);
        $this->db->bind(':ageFrom', isset($data['ageFrom']) ? $data['ageFrom'] : 0);
        $this->db->bind(':ageTo', isset($data['ageTo']) ? $data['ageTo'] : 0);
        $this->db->bind(':provinceId', $data['provinceId']);
        $this->db->bind(':cityId', $data['cityId']);
        $this->db->bind(':marital', $data['marital']);
        $results = $this->db->resultSet();
        return $results;
    }

    // Cat details
    public function catView($catId){
        $this->db->query('SELECT cats.catId, cats.catName, cats.age, cats.userId, cats.spouseId, cats.picture, cats.marital, genders.gender, 
                                      breeds.breed, colors.color, province, city FROM cats 
                                INNER JOIN genders ON cats.genderId=genders.genderId
                                INNER JOIN breeds ON cats.breedId=breeds.breedId
                                INNER JOIN colors ON cats.colorId=colors.colorId
                                LEFT JOIN (SELECT provinces.provinceId, provinces.province, cities.cityId, cities.city, users.userId FROM users 
                                              INNER JOIN provinces ON users.provinceId=provinces.provinceId
                                              INNER JOIN cities ON users.cityId=cities.cityId) 
                                              AS user1 ON cats.userId=user1.userId
                                WHERE cats.catId=:catId');
        $this->db->bind(':catId',$catId);
        $row = $this->db->single();

        if($row){
            return $row;
        }
        return false;
    }


    /* ============================================= Full text search =================================== */
    public function fullTextSearch($search){
        $this->db->query('SELECT * FROM users
                        INNER JOIN cities ON users.cityId = cities.cityId
                        INNER JOIN provinces ON users.provinceId = provinces.provinceId
                        INNER JOIN
                            (SELECT cats.catId,cats.catName,cats.age,cats.marital,cats.spouseId,cats.userId, colors.color,breeds.breed,genders.gender FROM cats
                            INNER JOIN colors ON cats.colorId = colors.colorId
                            INNER JOIN breeds ON cats.breedId = breeds.breedId
                            INNER JOIN genders ON cats.genderId = genders.genderId)
                        As catAlias ON users.userId = catAlias.userId
                        WHERE MATCH(userName,email,address,catName,breed,color,gender,city,province) Against(\'+\':search IN BOOLEAN MODE)');
        $this->db->bind(':search', $search);
        $row = $this->db->single();

        if($row){
            return $row;
        }
        return false;
    }

}

?>