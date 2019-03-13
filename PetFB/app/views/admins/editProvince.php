<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
        <h2>Edit Province</h2>

        <form action="<?php echo URL_ROOT; ?>/admins/editProvince/<?php echo $data['provinceId']; ?>" method="post">
        <div class="form-group">
            <label for="province">Province: <sup>*</sup></label>
            <input type="text" name="province" class="form-control form-control-lg <?php echo (!empty($data['province_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['province']; ?>">
            <span class="invalid-feedback"><?php echo $data['province_err'] ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
</div>




<?php require APPLICATION_ROOT . '/views/include/footer.php'?>