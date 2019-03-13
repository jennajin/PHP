<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2> Create Your Account</h2>
            <form action="<?php echo URL_ROOT; ?>/users/register" method="post">
                <div class="form-group">

                    <label for="userName">Name: <sup>*</sup></label>

                    <div class="input-group">
                        <!-- set a picture which is shown in each input box - Awesome font -->
                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                        <!-- is-invalid is a class that you can use for validation.
                         it shows the red outline around the tag if there is an issue
                         Server side :
                         We recommend using client side validation, but in case you require server side,
                         you can indicate invalid and valid form fields with .is-invalid and .is-valid.
                         Note that .invalid-feedback is also supported with these classes.
                         -->

                        <input type="text" name="userName" id="userName" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['userName']; ?>">
                    </div>
                    <!-- invalid-feedback
                                           For custom Bootstrap form validation messages, you’ll need to add the novalidate boolean attribute to your <form>.
                                           This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript.
                                           e.g:
                                           <form ... novalidate>
                                           ...
                                          <div class="invalid-feedback">
                                            Please provide a valid city.
                                          </div>
                                          </form>
                                          OR
                                          you can use the browser defaults. Try submitting the form below. Depending on your browser and OS,
                                          you’ll see a slightly different style of feedback.While these feedback styles cannot be styled with CSS,
                                          you can still customize the feedback text through JavaScript.

                                           -->
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>


                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <div class="input-group margin-bottom-sm">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                        <input type="email" name="email" id="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    </div>
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>

                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input type="password" name="password" id="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    </div>
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input type="password" name="confirm_password"  id="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                    </div>
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone: <sup>*</sup></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone fa-lg"></i></span>
                        <input type="text" name="phone" id="phone" class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>" maxlength="10">
                    </div>
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['phone_err']; ?></span>
                </div>

                <div class="form-group">
                    <label for="address">Address Line:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home fa-lg"></i></span>
                        <input type="text" name="address" id="address" class="form-control form-control-lg <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address']; ?>">
                    </div>
                    <span class="d-block my-0 invalid-feedback"><?php echo $data['address_err']; ?></span>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="provinceId">Province: </label>
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

                    <div class="form-group col">
                        <label for="cityId">City: </label>
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
                    <div class="col">
                        <input type="submit" value="Register" name="register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URL_ROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
                    </div> <!-- /col -->
                </div> <!-- /row -->
            </form>
        </div> <!-- /card -->
    </div> <!-- /col-md-6 -->
</div> <!-- /row -->

<br><br><br>

<?php require APPLICATION_ROOT . '/views/include/footer.php'?>