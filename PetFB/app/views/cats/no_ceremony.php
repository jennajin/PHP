<?php require APPLICATION_ROOT . '/views/include/header.php' ?>
<div class="row">
    <div class="card card-body bg-light mt-5 col-lg-10 mx-auto">
        <form class="form-horizontal" action="<?php echo URL_ROOT; ?>/cats/no_ceremony/<?php echo $_SESSION['user_id']; ?>" method="post">
            <div class="row">
                <div class="col">
                    <h1>No Ceremony</h1>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" value="Update My Cat" name="update" class="btn btn-warning btn-block">
                </div>
            </div>
        </form>
    </div>
</div>

<?php require APPLICATION_ROOT . '/views/include/footer.php' ?>