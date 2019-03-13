<?php require APPLICATION_ROOT . '/views/include/header.php'?>
   <div class="container card card-body my-5">
    <h1 class="card-title bg-light p-2 mb-3"> <i class="fa fa-users"></i><?php echo "  " . $data['title']; ?> </h1>
    <p><?php echo $data['description']; ?></p>
    <img src ="<?php echo URL_ROOT.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR?>about.png" height="600"/>
    <br/><br/>
    <p> Version : <?php echo APP_VERSION; ?></p>

   </div>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>