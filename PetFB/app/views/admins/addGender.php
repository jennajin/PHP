<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
        <h2> Add Gender </h2>
        <form action="<?php echo URL_ROOT; ?>/admins/addGender/<?php echo $data['genderId']; ?>" method="post">
            <div class="form-group">
                <label for="gender">Gender: <sup>*</sup></label>
                <input type="text" name="gender" class="form-control form-control-lg <?php echo (!empty($data['gender_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['gender']; ?>">
                <span class="invalid-feedback"><?php echo $data['gender_err'] ?></span>
            </div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>

    </div>
</div>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>