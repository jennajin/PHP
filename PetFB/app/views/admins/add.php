
<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
        <h2> Add Gender </h2>
        <form action="<?php echo URL_ROOT;?>/admins/add" method="post">
            <div class="form-group">
                <label for="title">Gender: <sup>*</sup></label>
                <div class="input-group margin-bottom-sm">

                    <input type="text" name="gender" id="gender"
                           class="form-control form-control-sm
                           <?php echo (!empty($data['gender_err'])) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $data['gender']; ?>"/>
                </div>

                <input type="submit" class="btn btn-success" value="Submit">
            </div>
        </form>
    </div>
</div>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>