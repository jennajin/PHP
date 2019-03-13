<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
        <h2> Add City </h2>
        <form action="<?php echo URL_ROOT;?>/admins/addCity" method="post">
            <div class="form-group">
                     <label for="city">City: <sup>*</sup></label>
                           <input type="text" name="city" id="city"
                           class="form-control form-control-lg
                           <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''; ?>"
                           value="<?php echo $data['city']; ?>"/>
                    <span class="invalid-feedback"><?php echo $data['city_err'] ?></span>
                </div>
                <div class="form-group">
                    <label for="provinceId">Province: </label>
                    <select class="form-control form-control-lg" name="provinceId" id="provinceId" onchange="this.form.submit();" >
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
                    <span class=" d-block my-0 invalid-feedback"><?php echo $data['provinceId_err'] ?></span>
                </div>
                    <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
</div>
<?php require APPLICATION_ROOT . '/views/include/footer.php' ?>
