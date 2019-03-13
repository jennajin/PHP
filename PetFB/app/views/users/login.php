<?php require APPLICATION_ROOT . '/views/include/header.php'?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php messageBox('register_success');?>
                <h2> Login</h2>
                <form action="<?php echo URL_ROOT;?>/users/login" method="post">

                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <div class="input-group">
                            <!-- set a picture which is shown in each input box - Awesome font -->
                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>

                            <!-- is-invalid is a class that you can use for validation.
                            it shows the red outline around the tag if there is an issue
                            Server side :
                            We recommend using client side validation, but in case you require server side,
                            you can indicate invalid and valid form fields with .is-invalid and .is-valid.
                            Note that .invalid-feedback is also supported with these classes.
                            -->
                           <input type="email" name="email" id="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
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
                        <span class="d-block my-0 invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                            <input type="password" name="password" id="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        </div>
                        <span class="d-block my-0 invalid-feedback "><?php echo $data['password_err']; ?></span>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URL_ROOT; ?>/users/register" class="btn btn-light btn-block">No account? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require APPLICATION_ROOT . '/views/include/footer.php'?>