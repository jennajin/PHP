<?php require APPLICATION_ROOT . '/views/include/header.php' ?>
<div class="row">
    <div class="card card-body bg-light mt-5 col-lg-10 col-lg-offset-2 mx-auto">
        <form class="form-horizontal" action="<?php echo URL_ROOT; ?>/cats/search/<?php echo $_SESSION['user_id']; ?>" method="post">
        <!--   <div class="row">
                <div class="form-group col-md-10">
                    <div class="input-group input-file ">
                        <input type="text" name="user_search" id="search" class="form-control form-control-lg ?php echo (!empty($data['user_search_err'])) ? 'is-invalid' : ''; ?>"
                               value="?php echo $data['user_search']; ?>" placeholder="Search cats..." />
                        <span class="input-group-btn"><button type="submit" class="btn btn-warning" name="full_text_search" id="search">&nbsp;&nbsp;<i class="fa fa-search"></i>&nbsp;&nbsp;</button></span>
                    </div>
                    <span class="d-block my-0 invalid-feedback">?php echo $data['search_err']; ?></span>
                </div> <!-- /col -->
        <!--  </div> -->

            <div class="row">
                <div class="form-group col-md-5">
                    <label for="genderId">Gender</label>
                    <select class="form-control form-control-lg" name="genderId" id="genderId"">
                    <?php
                    echo "<option value='0'></option>";
                    foreach ($data['genderLists'] as $genders)
                    {
                        if($data['genderId'] == $genders->genderId) {
                            echo "<option value='".$genders->genderId."' selected>".$genders->gender."</option>";
                        } else {
                            echo "<option value='".$genders->genderId."'>".$genders->gender."</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="breedId">Breed</label>
                    <select class="form-control form-control-lg" name="breedId" id="breedId"">
                    <?php
                    echo "<option value='0'></option>";
                    foreach ($data['breedLists'] as $breeds)
                    {
                        if($data['breedId'] == $breeds->breedId) {
                            echo "<option value='".$breeds->breedId."' selected>".$breeds->breed."</option>";
                        } else {
                            echo "<option value='".$breeds->breedId."'>".$breeds->breed."</option>";
                        }
                    }
                    ?>
                    </select>
                </div> <!-- /col -->
            </div> <!-- /row -->

            <div class="row">
                <div class="form-group col-md-5">
                    <label for="colorId">Color</label>
                    <select class="form-control form-control-lg" name="colorId" id="colorId"">
                    <?php
                    echo "<option value='0'></option>";
                    foreach ($data['colorLists'] as $colors)
                    {
                        if($data['colorId'] == $colors->colorId) {
                            echo "<option value='".$colors->colorId."' selected>".$colors->color."</option>";
                        } else {
                            echo "<option value='".$colors->colorId."'>".$colors->color."</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="provinceId">Province</label>
                    <select class="form-control form-control-lg" name="provinceId" id="provinceId" onchange="this.form.submit();">
                        <?php
                        echo "<option value='0'></option>";
                        foreach ($data['provinceLists'] as $provinces)
                        {
                            if($data['provinceId'] == $provinces->provinceId) {
                                echo "<option value='".$provinces->provinceId."' selected>".$provinces->province."</option>";
                            } else {
                                echo "<option value='".$provinces->provinceId."'>".$provinces->province."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="cityId">City</label>
                    <select class="form-control form-control-lg" name="cityId" id="cityId">
                        <?php
                        echo "<option value='0'></option>";
                        foreach ($data['cityLists'] as $cities)
                        {
                            if($data['cityId'] == $cities->cityId) {
                                echo "<option value='".$cities->cityId."' selected>".$cities->city."</option>";
                            } else {
                                echo "<option value='".$cities->cityId."'>".$cities->city."</option>";
                            }
                        }
                        ?>
                    </select>
                </div> <!-- /col -->
            </div> <!-- /row -->
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="marital">Marital</label>
                    <select class="form-control form-control-lg" name="marital" id="marital">
                        <option value='0'></option>
                        <?php
                            if($data['marital'] == 1) {
                                echo "<option value='1' selected>Single</option>";
                                echo "<option value='2'>In a relationship</option>";
                            } elseif($data['marital'] == 2){
                                echo "<option value='1'>Single</option>";
                                echo "<option value='2' selected>In a relationship</option>";
                            } else {
                                echo "<option value='1'>Single</option>";
                                echo "<option value='2'>In a relationship</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="age">Age from</label>
                    <input type="text" name="ageFrom" id="age" class="form-control form-control-lg <?php echo (!empty($data['age_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ageFrom']; ?>" maxlength="2">

                </div>
                <div class="form-group col-md-2">
                    <label for="age">to</label>
                    <input type="text" name="ageTo" class="form-control form-control-lg <?php echo (!empty($data['age_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ageTo']; ?>" maxlength="2">
                </div> <!-- /col -->
            </div> <!-- /row -->

            <div class="row">
                <div class="form-group col-md-5">
                </div>
                <div class="form-group col-md-5">
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['age_err']; ?></span>
                </div> <!-- /col -->
            </div> <!-- /row -->

            <div class="row">
                <div class="col-md-3">
                    <input type="submit" value="Search" name="search" class="btn btn-warning btn-block">
                </div>
                <div class="col-md-3">
                    <input type="submit" value="Clear" name="clear" class="btn btn-danger btn-block">
                </div> <!-- /col -->
            </div> <!-- /row: button -->


            <?php
                if(isset($_POST['search'])){
                    if($data['search_result']){
                        require APPLICATION_ROOT . '/views/cats/search_result.php';
                    } elseif($data['no_result']){
                        echo "<div class='mt-5 col-lg-5'>
                                   <div class='alert alert-danger'>
                                       <a class='panel-close close' data-dismiss='alert'>×</a>
                                       No Results Found.
                                   </div>
                               </div>";
                    }
                }
            ?>
        </form>
    </div>
</div>
<br><br><br>
<?php require APPLICATION_ROOT . '/views/include/footer.php' ?>