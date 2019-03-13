<?php
class Cats extends Controller
{
    public function __construct()
    {
        $this->catModel = $this->model('Cat');
        $this->userModel = $this->model('User');
    }

    /* ============================================= My Cat =============================================== */
    // 'My Cat' from menu bar
    public function index()
    {
        $data = null;
        // Get cat information
        $catInfo = $this->catModel->getCatByUserId($_SESSION['user_id']);

        // If cat information is exists
        if ($catInfo) {
            $data = [
                'catId' => $catInfo->catId,
                'catName' => $catInfo->catName,
                'age' => $catInfo->age,
                'gender' => $this->catModel->getGenderInfo($catInfo->genderId) ? $this->catModel->getGenderInfo($catInfo->genderId)->gender : null,
                'breed' => $this->catModel->getBreedInfo($catInfo->breedId) ? $this->catModel->getBreedInfo($catInfo->breedId)->breed : null,
                'color' => $this->catModel->getColorInfo($catInfo->colorId) ? $this->catModel->getColorInfo($catInfo->colorId)->color : null,
                'spouse' => $this->catModel->getSpouseInfo($catInfo->spouseId) ? $this->catModel->getSpouseInfo($catInfo->spouseId)->catName : null,
                'picture' => $catInfo->picture,
                'marital' => $catInfo->marital==2 ? 'In a relationship' : 'Single'
            ];
        } else {
            redirect('cats/no_cat');
        }
        $this->view('cats/index', $data);
    }

    // cat information doesn't exist
    public function no_cat()
    {
        // Add my cat button
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            redirect('cats/add');
        }
        $this->view('cats/no_cat');
    }

    /* ============================================= Add cat ============================================= */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $catInfo = $this->catModel->getCatByUserId($_SESSION['user_id']);

            $data = [
                'catName' => trim($_POST['catName']),
                'age' => trim($_POST['age']),
                'genderLists' => $this->catModel->getGenders(),
                'genderId' => trim($_POST['genderId']),
                'breedLists' => $this->catModel->getBreeds(),
                'breedId' => trim($_POST['breedId']),
                'colorLists' => $this->catModel->getColors(),
                'colorId' => trim($_POST['colorId']),
                'picture' => trim($_POST['picture']),
                'marital' => 1,
                'spouseId' => 0,
                'catName_err' => '',
                'age_err' => '',
                'gender_err' => '',
                'color_err' => '',
                'breed_err' => '',
                'picture_err' => ''
            ];

            //validation
            // catName
            if (empty($data['catName'])) {
                $data['catName_err'] = 'Please enter cat\'s name';
            }

            // age
            if ($data['age'] == null) {
                $data['age_err'] = 'Please enter cat\'s age';
            } elseif (!is_numeric($data['age']) || preg_match_all('/\.|\+/', $data['age'])) {
                $data['age_err'] = 'Please enter a valid age';
            } elseif($data['age'] < 0){
                $data['age_err'] = 'Age cannot be negative value';
            } elseif($data['age'] > 30){
                $data['age_err'] = 'Age cannot be greater than 30';
            }

            // gender
            if (!$data['genderId']) {
                $data['gender_err'] = 'Please select cat\'s gender';
            }

            // breed
            if (!$data['breedId']) {
                $data['breed_err'] = 'Please select cat\'s breed';
            }

            // color
            if (!$data['colorId']) {
                $data['color_err'] = 'Please select cat\'s color';
            }

            // picture
            if ($data['picture']) {
                $fileType = pathinfo($data['picture'], PATHINFO_EXTENSION);

                if (($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg")) {
                    $data['picture_err'] = "Only png, jpg and jepg files are allowed.";
                }
            }

            if (empty($data['catName_err']) && empty($data['age_err']) && empty($data['picture_err']) && empty($data['gender_err']) && empty($data['breed_err']) && empty($data['color_err'])) {
                //check if there is not any error
                if ($this->catModel->addCatInfo($data)) {
                    // add cat information
                    if ($data['picture']) {
                        $this->pictureUpload($data);
                    }
                    redirect('cats', $data);
                } else {
                    die('ERROR! - Edition is failed');
                }
            } else {
                $data['picture'] = null;
            }
        } else {
            // initial cat information
            $data = [
                'catName' => '',
                'age' => '',
                'genderLists' => $this->catModel->getGenders(),
                'genderId' => '',
                'breedLists' => $this->catModel->getBreeds(),
                'breedId' => '',
                'colorLists' => $this->catModel->getColors(),
                'colorId' => '',
                'picture' => '',
                'marital' => 1,
                'spouseId' => 0,
                'catName_err' => '',
                'age_err' => '',
                'gender_err' => '',
                'color_err' => '',
                'breed_err' => '',
                'picture_err' => ''
            ];
        }
        $this->view('cats/add', $data);

    }

    /* ============================================= Edit & Delete cat =================================== */
    public function edit()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // get cat information by Id
        $catInfo = $this->catModel->getCatByUserId($_SESSION['user_id']);

        if (isset($_POST['edit'])) {
            // edit cat information
            $data = [
                'catId' => $catInfo->catId,
                'catName' => trim($_POST['catName']),
                'age' => trim($_POST['age']),
                'genderLists' => $this->catModel->getGenders(),
                'genderId' => trim($_POST['genderId']),
                'breedLists' => $this->catModel->getBreeds(),
                'breedId' => trim($_POST['breedId']),
                'colorLists' => $this->catModel->getColors(),
                'colorId' => trim($_POST['colorId']),
                'picture' => trim($_POST['picture']),
                'marital' => trim($_POST['marital']),
                'spouseLists' => $this->catModel->getSpouses($catInfo),
                'spouseId' => isset($_POST['spouseId']) ? trim($_POST['spouseId']) : 0,
                'catName_err' => '',
                'age_err' => '',
                'gender_err' => '',
                'breed_err' => '',
                'color_err' => '',
                'picture_err' => ''
            ];

            // validation
            // catName
            if (empty($data['catName'])) {
                $data['catName_err'] = 'Please enter cat\'s name';
            }

            // age
            if ($data['age']==null) {
                $data['age_err'] = 'Please enter cat\'s age';
            } elseif (!is_numeric($data['age']) || preg_match_all('/\.|\+/', $data['age'])) {
                $data['age_err'] = 'Please enter a valid age';
            } elseif($data['age'] < 0){
                $data['age_err'] = 'Age cannot be negative value';
            } elseif($data['age'] > 30){
                $data['age_err'] = 'Age cannot be greater than 30';
            }

            // gender
            if (!$data['genderId']) {
                $data['gender_err'] = 'Please select cat\'s gender';
            }

            // breed
            if (!$data['breedId']) {
                $data['breed_err'] = 'Please select cat\'s breed';
            }

            // color
            if (!$data['colorId']) {
                $data['color_err'] = 'Please select cat\'s color';
            }

            // picture
            if ($data['picture']) {
                $fileType = pathinfo($data['picture'], PATHINFO_EXTENSION);

                if (($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg")) {
                    $data['picture_err'] = "Only png, jpg and jepg files are allowed.";
                }
            }

            //check if there is not any error
            if (empty($data['catName_err']) && empty($data['age_err']) && empty($data['picture_err']) && empty($data['gender_err']) && empty($data['breed_err']) && empty($data['color_err'])) {

                if ($this->catModel->editCatInfo($data)) {
                    // edit cat information
                    $this->pictureUpload($data);
                    redirect('cats', $data);
                } else {
                    die('ERROR! - Edition is failed');
                }
            } else {
                if ($catInfo->picture) {
                    $data['picture'] = $catInfo->picture;
                } else {
                    $data['picture'] = null;
                }
            }
        } else {
            // initial cat information
            $data = [
                'catId' => $catInfo->catId,
                'catName' => $catInfo->catName,
                'age' => $catInfo->age,
                'genderLists' => $this->catModel->getGenders(),
                'genderId' => $catInfo->genderId,
                'breedLists' => $this->catModel->getBreeds(),
                'breedId' => $catInfo->breedId,
                'colorLists' => $this->catModel->getColors(),
                'colorId' => $catInfo->colorId,
                'picture' => $catInfo->picture,
                'marital' => $catInfo->marital,
                'spouseLists' => $this->catModel->getSpouses($catInfo),
                'spouseId' => $catInfo->spouseId,
                'catName_err' => '',
                'age_err' => '',
                'color_err' => '',
                'breed_err' => '',
                'gender_err' => '',
                'picture_err' => ''
            ];
        }

        // Delete cat information
        if (isset($_POST['delete'])) {
            $data = $this->catModel->getCatByUserId($_SESSION['user_id']);

            if ($this->catModel->deleteCatInfo($data)) {
                redirect('cats/index');
                echo "success";
            } else {
                die('ERROR! - Deletion is failed');
            }
        }

        $this->view('cats/edit', $data);
    }


    /* ============================================= Upload a picture ==================================== */
    public function pictureUpload($data)
    {
        $target_path = getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'user' . $_SESSION['user_id'] . DIRECTORY_SEPARATOR;
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

    /* ============================================= Ceremony ============================================ */
    public function ceremony()
    {
        $data = null;
        // Get cat information
        $catInfo = $this->catModel->getCatByUserId($_SESSION['user_id']);

        if (isset($catInfo->spouseId)) {
            $spouseInfo = $this->catModel->getSpouseInfo($catInfo->spouseId);
        }

        // If cat & spouse information is exists
        if ($catInfo && $catInfo->spouseId) {
            $data = [
                'catId' => $catInfo->catId,
                'catName' => $catInfo->catName,
                'genderId' => $catInfo->genderId,
                'picture' => $catInfo->picture,
                'marital' => $catInfo->marital,
                'spouseId' => $catInfo->spouseId,
                'spouseUserId' => $spouseInfo->userId,
                'spouseName' => isset($spouseInfo) ? $spouseInfo->catName : '',
                'spousePicture' => isset($spouseInfo) ? $spouseInfo->picture : '',
                'spouseGender' => isset($spouseInfo) ? $spouseInfo->genderId : ''
            ];
        } else {
            redirect('cats/no_ceremony');
        }

        $this->view('cats/ceremony', $data);
    }

    // Cannot display ceremony: no cat or no spouse
    public function no_ceremony()
    {
        // Update my cat button
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            redirect('cats/index');
        }
        $this->view('cats/no_ceremony');
    }

    /* ============================================= Search ============================================= */
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'genderLists' => $this->catModel->getGenders(),
                'genderId' => trim($_POST['genderId']),
                'breedLists' => $this->catModel->getBreeds(),
                'breedId' => trim($_POST['breedId']),
                'colorLists' => $this->catModel->getColors(),
                'colorId' => trim($_POST['colorId']),
                'provinceLists' => $this->userModel->getProvinces(),
                'provinceId' => trim($_POST['provinceId']),
                'cityLists' => $this->userModel->getCities($_POST['provinceId']),
                'cityId' => trim($_POST['cityId']),
                'marital' => trim($_POST['marital']),
                'ageFrom' => trim($_POST['ageFrom']),
                'ageTo' => trim($_POST['ageTo']),
                'age_err' => '',
                'search_result' => '',
                'no_result' => ''
            ];

            // Clear
            if (isset($_POST['clear'])) {
                // initial cat information
                $data = [
                    'genderLists' => $this->catModel->getGenders(),
                    'genderId' => 0,
                    'breedLists' => $this->catModel->getBreeds(),
                    'breedId' => 0,
                    'colorLists' => $this->catModel->getColors(),
                    'colorId' => 0,
                    'provinceLists' => $this->userModel->getProvinces(),
                    'provinceId' => 0,
                    'cityLists' => 0,
                    'cityId' => 0,
                    'marital' => 0,
                    'ageFrom' => '',
                    'ageTo' => '',
                    'age_err' => '',
                    'search_result' => '',
                    'no_result' => ''
                ];
            }

            // age validation
            if (!empty($data['ageFrom']) || !empty($data['ageTo'])) {
                if (!is_numeric($data['ageFrom']) || !is_numeric($data['ageTo']) || preg_match('/\.|\+|\-/', $data['ageFrom']) || preg_match('/\.|\+|\-/', $data['ageTo'])) {
                    $data['age_err'] = 'Please enter a valid age';
                } elseif ($data['ageFrom'] > $data['ageTo']) {
                    $data['age_err'] = 'Age from value cannot be greater than Age to';
                } elseif($data['ageFrom'] > 30 || $data['ageTo'] > 30){
                    $data['age_err'] = 'Age cannot be greater than 30';
                }
            }

            // If there is no errors
            if (empty($data['age_err'])) {
                $search_result = $this->catModel->searchResult($data);
                if(count($search_result)){
                    $data['search_result'] = $search_result;
                } elseif(count($search_result)==0) {
                    $data['no_result'] = true;
                }

                $this->view('cats/search', $data);
            } else {
                //load the view with errors
                $this->view('cats/search', $data);
            }
        } else {
            // initial cat information
            $data = [
                'genderLists' => $this->catModel->getGenders(),
                'genderId' => 0,
                'breedLists' => $this->catModel->getBreeds(),
                'breedId' => 0,
                'colorLists' => $this->catModel->getColors(),
                'colorId' => 0,
                'provinceLists' => $this->userModel->getProvinces(),
                'provinceId' => 0,
                'cityLists' => 0,
                'cityId' => $this->userModel->getCities('provinceId'),
                'marital' => 0,
                'ageFrom' => '',
                'ageTo' => '',
                'age_err' => '',
                'search_result' => '',
                'no_result' => ''
            ];
            $this->view('cats/search', $data);
        }
    }

    // View the search detail
    public function search_detail(){
        $catInfo=$this->catModel->catView(intval(basename($_SERVER["REQUEST_URI"])));
        $spouseInfo=$this->catModel->getSpouseInfo($catInfo->spouseId);

        $data = [
            'catName' => $catInfo->catName,
            'userId' => $catInfo->userId,
            'gender' => $catInfo->gender,
            'age' => $catInfo->age,
            'breed' => $catInfo->breed,
            'color' => $catInfo->color,
            'marital' => $catInfo->marital==2 ? 'In a relationship' : 'Single',
            'province' => $catInfo->province,
            'city' => $catInfo->city,
            'picture' => $catInfo->picture,
            'spouse' => ($catInfo->spouseId != "0") ? $spouseInfo->catName : 0
        ];

        $this->view('cats/search_detail', $data);
    }
}
