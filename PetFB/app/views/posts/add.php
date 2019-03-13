<?php require APPLICATION_ROOT . '/views/include/header.php'?>
    <a href="<?php echo URL_ROOT ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back </a>
     <div class="card card-body bg-light mt-5">
        <h2> Add Post </h2>
        <form action="<?php echo URL_ROOT;?>/posts/add" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <div class="input-group margin-bottom-sm">
                    <!-- set a picture which is shown in each input box - Awesome font -->
                    <span class="input-group-addon"><i class="fa fa-header fa-fw"></i></span>

                    <!-- is-invalid is a class that you can use for validation.
                    it shows the red outline around the tag if there is an issue
                    Server side :
                    We recommend using client side validation, but in case you require server side,
                    you can indicate invalid and valid form fields with .is-invalid and .is-valid.
                    Note that .invalid-feedback is also supported with these classes.
                    -->
                    <input type="text" name="title" id="title" class="form-control form-control-lg
                    <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                           value="<?php echo $data['title']; ?>"/>
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
                <span class="d-block my-0 invalid-feedback"><?php echo $data['title_err']; ?></span>

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
            </div>

            <div class="form-group">
                <label for="body">Body: <sup>*</sup></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-comments fa-fw"></i></span>
                    <textarea name="body" id="body" rows = "5" class="form-control form-control-lg
                    <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>">
                        <?php echo $data['body']; ?> </textarea>
                </div>
                <span class="d-block my-0 invalid-feedback "><?php echo $data['body_err']; ?></span>
            </div>

            <input type="submit" class="btn btn-success pull-right" value="Submit">
        </form>
     </div>

    <script>
        // When browse button is clicked, file upload is available
        document.getElementById('browse').addEventListener('click', function() {
            document.getElementById('files_upload').click();
        });
        document.getElementById('files_upload').addEventListener('change', function() {
            document.getElementById('picture_name').value = this.value.replace(/^.*[\\\/]/, '');
        });
    </script>

<?php require APPLICATION_ROOT . '/views/include/footer.php'?>