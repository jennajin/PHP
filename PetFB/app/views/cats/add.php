<?php require APPLICATION_ROOT . '/views/include/header.php' ?>
<div class="row">
    <div class="card card-body bg-light mt-5 col-lg-10 col-lg-offset-2">
        <form class="form-horizontal" action="<?php echo URL_ROOT; ?>/cats/add/<?php echo $_SESSION['user_id']; ?>" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="catName">Cat Name: <sup>*</sup></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-github-alt fa-lg"></i></span>
                        <input type="text" name="catName" id="catName" class="form-control form-control-lg <?php echo (!empty($data['catName_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['catName']; ?>">
                    </div>
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['catName_err']; ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="age">Age: <sup>*</sup></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-paw fa-lg"></i></span>
                        <input type="text" name="age" id="age" class="form-control form-control-lg <?php echo (!empty($data['age_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['age']; ?>" maxlength="2">
                    </div>
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['age_err']; ?></span>
                </div> <!-- /col -->
            </div> <!-- /row -->

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="genderId">Gender: <sup>*</sup></label>
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
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['gender_err']; ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="breedId">Breed: <sup>*</sup></label>
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
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['breed_err']; ?></span>
                </div> <!-- /col -->
            </div> <!-- /row -->

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="colorId">Color: <sup>*</sup></label>
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
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['color_err']; ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="files_upload">Picture:</label>
                    <div class="input-group input-file ">
                        <span class="input-group-addon"><i class="fa fa-picture-o fa-lg"></i></span>
                        <input type="text" name="picture" id="picture_name" class="form-control form-control-lg <?php echo (!empty($data['picture_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['picture']; ?>" readonly />
                        <input type="file" name="picture" id="files_upload" style="display:none" accept='.png, .jpg, .jpeg'>
                        <span class="input-group-btn"><button class="btn btn-default" id="browse" type="button"><i class="fa fa-search"></i>&nbsp;&nbsp;Browse</button></span>
                    </div>
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['picture_err']; ?></span>
                </div> <!-- /col -->
            </div> <!-- /row -->

            <!-- buttons -->
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" value="Add" name="add" class="btn btn-primary btn-block">
                </div> <!-- /col -->
            </div> <!-- /row: buttons -->
        </form>
    </div> <!-- /card -->
</div><!-- /row -->

<script>
    // When browse button is clicked, file upload is available
    document.getElementById('browse').addEventListener('click', function() {
        document.getElementById('files_upload').click();
    });
    document.getElementById('files_upload').addEventListener('change', function() {
        document.getElementById('picture_name').value = this.value.replace(/^.*[\\\/]/, '');
    });

    // When In relationship with button is checked, the cat can select his/her spouse
    document.getElementById('marital_0').addEventListener('click', function(){
        // single: no spouseId
        document.getElementById("spouseId").selectedIndex=0;
        document.getElementById("spouseId").disabled = true;
    });
    document.getElementById('marital_1').addEventListener('click', function(){
        // in relationship with: spouseId
        document.getElementById("spouseId").disabled = false;
    });
</script>


<?php require APPLICATION_ROOT . '/views/include/footer.php' ?>
