<?php require APPLICATION_ROOT . '/views/include/header.php' ?>
<div class="row">
    <div class="card card-body bg-light mt-5 col-lg-10 mx-auto">
        <form class="form-horizontal" action="<?php echo URL_ROOT; ?>/cats/<?php echo $data['catId']; ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class='row'>
                    <!-- left column: a picture -->
                    <div class='col-md-4 col-xs-12'>
                        <div class='text-center'>
                            <?php
                            $real_picture =  URL_ROOT.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.'user'.$data['userId'].DIRECTORY_SEPARATOR.$data['picture'];
                            if($data['picture']){
                                echo '<img src="'.$real_picture.'" class=\'img-thumbnail\' alt=\'my_cat\'/>';
                            } else{
                                echo "";
                            }
                            ?>
                        </div>
                    </div> <!-- /column: picture -->

                    <!-- right column: cat information -->
                    <div class="col-md-8 ">
                        <div class="form-group">
                            <b><label class="col-lg-3 control-label">Cat Name</label></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['catName'].' (User '.$data['userId'].')'; ?>
                        </div>
                        <div class="form-group">
                            <b><label class="col-lg-3 control-label">Age</label></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['age']; ?>
                        </div>
                        <div class="form-group">
                            <b><label class="col-lg-3 control-label">Gender</label></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['gender']; ?>
                        </div>
                        <div class="form-group">
                            <b><label class="col-lg-3 control-label">Breed</label></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['breed']; ?>
                        </div>
                        <div class="form-group">
                            <b><label class="col-lg-3 control-label">Color</label></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['color']; ?>
                        </div>
                        <div class="form-group">
                            <b><label class="col-lg-3 control-label">Province</label></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['province']; ?>
                        </div>
                        <div class="form-group">
                            <b><label class="col-lg-3 control-label">City</label></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['city']; ?>
                        </div>
                        <div class="form-group">
                            <b><label class="col-lg-3 control-label">Marital Status</label></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['marital']; ?>
                        </div>
                        <?php
                        if($data['spouse']){
                            echo "<div class='form-group'>
                                            <b><label class='col-lg-3 control-label'>Spouse</label></b>&nbsp;&nbsp;&nbsp;&nbsp;{$data['spouse']}
                                  </div>";
                        }
                        ?>

                    </div> <!-- /cat info column -->
                </div>  <!-- /row: cat picture and info -->
            </div> <!-- /card-body -->

            <div class="row">
                <div class="col-md-3">
                    <?php
                    echo "</th>
                    <th><a href='".URL_ROOT."/cats/search/".$_SESSION['user_id']."'
                       class='btn btn-primary btn-block'>Back</a>
                    </tr>"; ?>
                </div>
            </div>

        </form>
    </div> <!-- /card -->
</div><!-- /row -->

<script>

</script>
<br><br><br>

<?php require APPLICATION_ROOT . '/views/include/footer.php' ?>

