<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-4"> <?php echo $data['title']; ?> </h1>
        <p class="lead"> <?php echo $data['description']; ?> </p>
        <img src ="<?php echo URL_ROOT.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR?>splash.jpg" width="300" height="300" class="rounded-circle"/>
        <br/><br/>

    </div>
</div>

<?php require APPLICATION_ROOT . '/views/include/footer.php'?>