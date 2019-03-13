<?php

class Admins extends Controller
{

    public function __construct()
    {
        $this->admincatModel = $this->model('AdminCat');;
        $this->adminModel = $this->model('Admin');;
        $this->adminuserModel=$this->model('AdminUser');
        $this->catModel=$this->model('Cat');

}


    public function index()
    {//Get information from model about genders,breeds,colors,provinces and cities
        $genders = $this->adminModel->getGenders();
        $breeds = $this->adminModel->getBreeds();
        $colors = $this->adminModel->getColors();
        $provinces = $this->adminuserModel->getProvinces();
       $cities = $this->adminModel->getCities();
        $data = [
            'genders' => $genders,
            'breeds' => $breeds,
            'colors' => $colors,
            'provinces' => $provinces,
            'cities' => $cities
        ];
        $this->view('admins/index', $data);

    }

//----------------Adding new gender,color,breed,province,city--------------
    public function addGender()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'gender' => trim($_POST['gender']),
                'gender_err' => '',
            ];
            //validation
            if (empty($data['gender'])) {
                $data['gender_err'] = 'Please enter gender';
            }
            if (empty($data['gender_err'])) {
                if ($this->adminModel->addGender($data)) {
                    messageBox('admuser_message', 'Gender Added.');
                    redirect('admins');
                } else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/addGender', $data);
            }
        } else {
            $data = [
                'gender' => ''
            ];
            $this->view('admins/addGender', $data);
        }
    }

    public function addColor()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'color' => trim($_POST['color']),
                'color_err' => '',
            ];
            //validation
            if (empty($data['color'])) {
                $data['color_err'] = 'Please enter color';
            }
            if (empty($data['color_err'])) {
                if ($this->adminModel->addColor($data)) {
                    messageBox('admuser_message', 'Color Added.');
                    redirect('admins');
                } else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/addColor', $data);
            }
        } else {
            $data = [
                'color' => ''
            ];
            $this->view('admins/addColor', $data);
        }
    }

    public function addBreed()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'breed' => trim($_POST['breed']),
                'breed_err' => '',
            ];
            //validation
            if (empty($data['breed'])) {
                $data['breed_err'] = 'Please enter breed';
            }
            if (empty($data['breed_err'])) {
                if ($this->adminModel->addBreed($data)) {
                    messageBox('admuser_message', 'Breed Added.');
                    redirect('admins');
                } else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/addBreed', $data);
            }
        } else {
            $data = [
                'breed' => ''
            ];
            $this->view('admins/addBreed', $data);
        }
    }



    public function addProvince()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'province' => trim($_POST['province']),
                'province_err' => '',
            ];
            //validation
            if (empty($data['province'])) {
                $data['province_err'] = 'Please enter province';
            }

            if (empty($data['province_err'])) {
                if ($this->adminModel->addProvince($data)) {
                    messageBox('admuser_message', 'Province Added.');
                    redirect('admins');
                } else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/addProvince', $data);
            }
        } else {
            $data = [
                'province' => ''
            ];
            $this->view('admins/addProvince', $data);
        }
    }

    public function addCity()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'city' => trim($_POST['city']),
                'provinceLists'=>$this->adminuserModel->getProvinces(),
                'provinceId'=>trim($_POST['provinceId']),
                'city_err' => '',
                'provinceId_err'=>''
                        ];


            //validation
            if (empty($data['city'])) {
                $data['city_err'] = 'Please enter city';
            }
            if (!($data['provinceId'])) {
               $data['provinceId_err'] = 'Please select province ';
          }
            if (empty($data['city_err'])&&empty($data['provinceId_err'])) {
                if ($this->adminModel->addCity($data)) {
                    messageBox('admuser_message', 'City Added.');
                    redirect('admins');
                } else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/addCity', $data);
            }
        } else {
            $data = [
                'city' => '',
                'provinceLists'=>$this->adminuserModel->getProvinces(),
                'provinceId'=>'',
                'city_err'=>'',
                'provinceId_err'=>''

            ];
            $this->view('admins/addCity', $data);
        }
    }



//----------------------------Editing gender,color,breed,city,province------------
    public function edit($id)
    {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $genderInfo = $this->adminModel->getGenderById($id);
        $data = [
            'genderId' => $id,
            'gender' => $genderInfo->gender,
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST')   {
            $data = [
                'genderId' => $id,
                'gender' => trim($_POST['gender']),
                'gender_err' => '',
            ];

            //validation of the form elements
            if (empty($data['gender'])) {
                $data['gender_err'] = 'Please enter gender';
            }

            //check for existance of errors --
            // if there is not, gender_err must be empty
            if (empty($data['gender_err'])) {

                if (($this->adminModel->editGender($data))) {
                    messageBox('admuser_message', 'Gender Updated');
                    redirect('admins');
                }
                else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/edit', $data);
            }
        }
        $this->view('admins/edit', $data);
    }

    public function editColor($id){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $colorInfo=$this->adminModel->getColorById($id);
        $data = [
            'colorId'=>$id,
            'color'=>$colorInfo->color
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
            $data = [
                'colorId' => $id,
                'color' => trim($_POST['color']),
                'color_err' => '',
            ];

            //validation of the form elements
            if (empty($data['color'])) {
                $data['color_err'] = 'Please enter color';
            }

            //check for existance of errors --
            // if there is not, gender_err must be empty
            if (empty($data['color_err'])) {

                if (($this->adminModel->editColor($data))) {
                    messageBox('admuser_message', 'Color Updated');
                    redirect('admins');
                }
                else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/editColor', $data);
            }
        }
        $this->view('admins/editColor', $data);
    }

    public function editBreed($id){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $breedInfo=$this->adminModel->getBreedById($id);
        $data = [
            'breedId'=>$id,
            'breed'=>$breedInfo->breed
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
            $data = [
                'breedId' => $id,
                'breed' => trim($_POST['breed']),
                'breed_err' => '',
            ];

            //validation of the form elements
            if (empty($data['breed'])) {
                $data['breed_err'] = 'Please enter breed';
            }

            //check for existance of errors --
               if (empty($data['breed_err'])) {
                    if (($this->adminModel->editBreed($data))) {
                    messageBox('admuser_message', 'Breed Updated');
                    redirect('admins');
                }
                else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/editBreed', $data);
            }
        }
        $this->view('admins/editBreed', $data);


    }

    public function editProvince($id){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $provinceInfo=$this->adminModel->getProvinceById($id);
        $data = [
            'provinceId'=>$id,
            'province'=>$provinceInfo->province
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
            $data = [
                'provinceId' => $id,
                'province' => trim($_POST['province']),
                'province_err' => '',
            ];
            //validation of the form elements
            if (empty($data['province'])) {
                $data['province_err'] = 'Please enter province';
            }
            //check for existance of errors --
            if (empty($data['province_err'])) {
                if (($this->adminModel->editProvince($data))) {
                    messageBox('admuser_message', 'Province Updated');
                    redirect('admins');
                }
                else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/editProvince', $data);
            }
        }
        $this->view('admins/editProvince', $data);
    }

    public function editCity($id){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $cityInfo=$this->adminModel->getCityById($id);
       $data = [
            'cityId'=>$id,
            'city'=>$cityInfo->city,
            'provinceLists'=>$this->adminuserModel->getProvinces(),
            'provinceId'=>$cityInfo->provinceId
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
            $data = [
                'cityId' => $id,
                'city' => trim($_POST['city']),
                'provinceLists'=>$this->adminuserModel->getProvinces(),
                'provinceId'=>trim($_POST['provinceId']),
                'city_err' => '',
                'provinceId_err'=>''
            ];

            //validation of the form elements
            if (empty($data['city'])) {
                $data['city_err'] = 'Please enter city';
            }
            if (empty($data['provinceId'])) {
                $data['provinceId_err'] = 'Please select province';
            }
            //check for existance of errors --
            if (empty($data['city_err'])&&empty($data['provinceId_err'])) {
                if (($this->adminModel->editCity($data))) {
                    messageBox('admuser_message', 'City Updated');
                    redirect('admins');
                }
                else {
                    die('there is an issue.');
                }
            } else {
                // load the view with errors
                $this->view('admins/editCity', $data);
            }
        }

        $this->view('admins/editCity', $data);
    }

//---------------------------Delete gender,color,breed,province,city---------
    public function delete($id)
    {
          if (isset($_POST['deleteGender'])) {
            // Get existing gender from model
            $gender = $this->adminModel->getGenderById($id);
            if ($this->adminModel->deleteGender($id)) {

                messageBox('admuser_message', 'Gender Deleted');
                redirect('admins');
            }
        }
        if (isset($_POST['deleteColor'])) {
            // Get existing color from model
            $color = $this->adminModel->getColorById($id);
            if ($this->adminModel->deleteColor($id)) {

                messageBox('admuser_message', 'Color Deleted');
                redirect('admins');
            }
        }

        if (isset($_POST['deleteBreed'])) {
            // Get existing breed from model
            $breed = $this->adminModel->getBreedById($id);
            if ($this->adminModel->deleteBreed($id)) {
                messageBox('admuser_message', 'Breed Deleted');
                redirect('admins');
            }
        }

        if (isset($_POST['deleteProvince'])) {
            // Get existing province from model
            $province = $this->adminModel->getProvinceById($id);
            if ($this->adminModel->deleteProvince($id)) {
                messageBox('admuser_message', 'Province Deleted');
                redirect('admins');
            }
        }

        if (isset($_POST['deleteCity'])) {
            // Get existing city from model
            $province = $this->adminModel->getCityById($id);
            if ($this->adminModel->deleteCity($id)) {
                messageBox('admuser_message', 'City Deleted');
                redirect('admins');
            }
        }

    }

}