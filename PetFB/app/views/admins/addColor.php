<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
        <h2> Add Color </h2>
        <form action="<?php echo URL_ROOT;?>/admins/addColor" method="post">
            <div class="form-group">
                <label for="color">Color: <sup>*</sup></label>
                           <input type="text" name="color" id="color"
                           class="form-control form-control-lg
                           <?php echo (!empty($data['color_err'])) ? 'is-invalid' : ''; ?>"
                           value="<?php echo $data['color']; ?>"/>
                  <span class="invalid-feedback"><?php echo $data['color_err'] ?></span>
            </div>
                <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
</div>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>