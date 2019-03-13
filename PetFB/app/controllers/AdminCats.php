<?php

class AdminCats extends Controller
{
    public function __construct()
    {
        if (!(isLoggedIn())) {
            redirect('users/login');
        }
        $this->admincatModel = $this->model('AdminCat');
        $this->adminuserModel = $this->model('AdminUser');
        $this->adminModel = $this->model('Admin');
        $this->catModel = $this->model('Cat');
    }

    public function index(){
        //Get cats from db
        $cats = $this->admincatModel->getCats();
        $data = [
            'cats' => $cats
        ];

        $this->view('admincats/index', $data);
    }

    public function show()
    {
        if (isset($_POST['search'])) {
            $catName = $_POST['search'];
            $cat = $this->admincatModel->getCatByName($catName);
            $user=$this->adminuserModel->getUserById($cat->userId);

            $data = [
                'cat' => $cat,
                'user'=>$user
            ];

            $this->view('admincats/show', $data);
        }

    }

    public function edit($id)
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // get cat information by Id
        $catInfo = $this->admincatModel->getCatByUserId($id);


        if (isset($_POST['edit'])) {
            // edit cat information
            $data = [
                'catId' => $id,
                'catName' => trim($_POST['catName']),
                'age' => trim($_POST['age']),
                'genderLists' => $this->adminModel->getGenders(),
                'genderId' => trim($_POST['genderId']),
                'breedLists' => $this->adminModel->getBreeds(),
                'breedId' => trim($_POST['breedId']),
                'colorLists' => $this->adminModel->getColors(),
                'colorId' => trim($_POST['colorId']),
                'picture' => trim($_POST['picture']),
                'marital' => trim($_POST['marital']),
                'spouseLists' => $this->catModel->getSpouses($catInfo),
                'spouseId' => isset($_POST['spouseId']) ? trim($_POST['spouseId']) : 0,
                'catName_err' => '',
                'age_err' => '',
                'gender_err' => '',
                'picture_err' => ''
            ];

            // validation
            // catName
            if (empty($data['catName'])) {
                $data['catName_err'] = 'Please enter cat\'s name';
            }

            // age
            if (empty($data['age'])) {
                $data['age_err'] = 'Please enter cat\'s age';
            } elseif (!is_numeric($data['age']) || preg_match('/\./', $data['age'])) {
                $data['age_err'] = 'Please enter a valid age';
            }

            // gender
            if (!$data['genderId']) {
                $data['gender_err'] = 'Please select cat\'s gender';
            }

            // picture
            if ($data['picture']) {
                $fileType = pathinfo($data['picture'], PATHINFO_EXTENSION);

                if (($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg")) {
                    $data['picture_err'] = "Only png, jpg and jepg files are allowed.";
                }
            }

            //check if there is not any error
            if (empty($data['catName_err']) && empty($data['age_err']) && empty($data['picture_err']) && empty($data['gender_err'])) {

                if ($this->admincatModel->updateCat($data)) {
                    // edit cat information
               //     $this->pictureUpload($data);
                    messageBox('admuser_message', ' Cat updated');
                    redirect('admincats', $data);
                } else {
                    die('There is an issue');
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
                'genderLists' => $this->adminModel->getGenders(),
                'genderId' => $catInfo->genderId,
                'breedLists' => $this->adminModel->getBreeds(),
                'breedId' => $catInfo->breedId,
                'colorLists' => $this->adminModel->getColors(),
                'colorId' => $catInfo->colorId,
                'picture' => $catInfo->picture,
                'marital' => $catInfo->marital,
                'spouseLists' => $this->catModel->getSpouses($catInfo),
                'spouseId' => $catInfo->spouseId,
                'catName_err' => '',
                'age_err' => '',
                'gender_err' => '',
                'picture_err' => ''
            ];
        }
        $this->view('admincats/edit', $data);
    }


    public function delete($id){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get existing cat from model
            $cat=$this->admincatModel->getCatByUserId($id);
            print_r($cat);
            if($this->admincatModel->deleteCat($id)){
                messageBox('admuser_message', 'Cat Deleted');
                redirect('admincats');
            }
            else {
                die('there is an issue.');
            }
        }
        else {
            redirect('posts');
        }
    }
}
