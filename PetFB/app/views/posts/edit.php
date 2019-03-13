<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit Post</h2>
    <form action="<?php echo URL_ROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
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
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>

    <script>
        // When browse button is clicked, file upload is available
        document.getElementById('browse').addEventListener('click', function() {
            document.getElementById('files_upload').click();
        });

        // Picture name is shown in the text box
        document.getElementById('files_upload').addEventListener('change', function() {
            document.getElementById('picture_name').value = this.value.replace(/^.*[\\\/]/, '');
        });
    </script>

<?php require APPLICATION_ROOT . '/views/include/footer.php'?>