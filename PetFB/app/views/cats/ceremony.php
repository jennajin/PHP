<?php require APPLICATION_ROOT . '/views/include/header.php';

// path
$cat_path =  URL_ROOT.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.'user'.$_SESSION['user_id'].DIRECTORY_SEPARATOR;
$spouse_path =  URL_ROOT.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'user'.$data['spouseUserId'].DIRECTORY_SEPARATOR;
$ceremony_path =  URL_ROOT.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'ceremony'.DIRECTORY_SEPARATOR;
$heart_img = "heart1.gif";

// gender symbols
if($data['genderId']==1){
    $gender= "&#9794;";
} elseif($data['genderId']==2){
    $gender= "&#9792;";
}

if($data['spouseGender']==1){
    $spouseGender= "&#9794;";
} elseif($data['spouseGender']==2){
    $spouseGender= "&#9792;";
}
?>

<div class="row">
    <div class="card card-body bg-light mt-5 col-lg-10 mx-auto">
        <form class="form-horizontal" action="<?php echo URL_ROOT; ?>/cats/ceremony/<?php echo $_SESSION['user_id']; ?>" method="post" enctype="multipart/form-data">
            <h1><p class="text-center text-warning">CONGRATULATIONS!</p></h1>
            <div class="card-body">

                <!-- row: pictures -->
                <div class='row'>
                    <!-- left column: my cat -->
                    <div class='col col-md-5 text-center'>
                            <?php
                            if($data['picture']){
                                echo '<img src="'.$cat_path.$data['picture'].'" class=\'img-thumbnail ceremony_cat\' alt=\'ceremony_pict1\' style=\'height:200px;width:200px;\'/>';
                            } else{
                                echo "";
                            }
                            ?>

                    </div> <!-- /column: picture -->

                    <!-- middle column: heart image -->
                    <div class='col col-md-2 text-center jumbotron'  style="background:inherit;">
                        <?php
                        echo '<img src="'.$ceremony_path.$heart_img.'" class=\'img-fluid\' alt=\'heart_pic\' style=\'background:inherit;\' />';
                        ?>
                    </div> <!-- /column: picture -->


                    <!-- right column: spouse -->
                    <div class="col col-md-5 text-center">
                            <?php
                            if($data['spousePicture']){
                                echo '<img src="'.$spouse_path.$data['spousePicture'].'" class=\'img-thumbnail ceremony_cat\' alt=\'ceremony_pic2\' style=\'height:200px;width:200px;\'/>';
                            } else{
                                echo "";
                            }
                            ?>
                    </div> <!-- /col-->
                </div> <!-- /row: picture -->

                <!-- row: cats' name -->
                <div class='row'>
                    <!-- left column: my cat -->
                    <div class='col col-md-5 text-center'>
                        <h2><?php echo $data['catName']." (".$gender.")"; ?></h2>
                    </div>

                    <!-- middle column -->
                    <div class='col col-md-2'></div>

                    <!-- right column: spouse -->
                    <div class='col col-md-5 text-center'>
                        <h2><?php echo $data['spouseName']." (".$spouseGender.")"; ?></h2>
                    </div>
                </div> <!-- column: spouse -->
            </div> <!-- /card-body -->
        </form>
    </div> <!-- /card-body bg-light -->
</div> <!-- /row -->

<?php require APPLICATION_ROOT . '/views/include/footer.php' ?>
