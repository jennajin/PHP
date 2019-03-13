<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
        <h2> Add Breed </h2>
        <form action="<?php echo URL_ROOT;?>/admins/addBreed" method="post">
            <div class="form-group">
               <label for="breed">Breed: <sup>*</sup></label>
               <input type="text" name="breed" id="breed"
               class="form-control form-control-lg
               <?php echo (!empty($data['breed_err'])) ? 'is-invalid' : ''; ?>"
               value="<?php echo $data['breed']; ?>"/>
               <span class="invalid-feedback"><?php echo $data['breed_err'] ?></span>
            </div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
</div>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>