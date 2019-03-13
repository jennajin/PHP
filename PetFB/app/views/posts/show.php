<?php require APPLICATION_ROOT . '/views/include/header.php'?>
    <a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

    <div class="container card card-body bg-light mt-5">
        <h1><?php echo $data['post']->title; ?></h1>
        <div class="bg-secondary text-white p-2 mb-3">
            Written by <?php echo $data['user']->userName; ?> on <?php echo $data['post']->createdAt; ?>
        </div>

        <p class="card-text">
            <?php

            $real_picture =  URL_ROOT.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.'user'.
                $data['post']->userId .DIRECTORY_SEPARATOR.'posts'. DIRECTORY_SEPARATOR.$data['post']->picture;

            if($data['post']->picture){
                echo '<img src="'.$real_picture.'" class=\'img-thumbnail\' alt=\"my_post\"/>';
            } else{
                echo "";
            }
            ?>
        </p>

        <p><?php echo $data['post']->body; ?></p>

        <?php if($data['post']->userId == $_SESSION['user_id']) : ?>
            <div class="card-footer">
            <a href="<?php echo URL_ROOT; ?>/posts/edit/<?php echo $data['post']->postId; ?>" class="btn btn-warning">Edit</a>

            <form class="pull-right" action="<?php echo URL_ROOT; ?>/posts/delete/<?php echo $data['post']->postId; ?>" method="post">
                <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete it?');">
            </form>
            </div>
        <?php endif; ?>
    </div>

<?php require APPLICATION_ROOT . '/views/include/footer.php'?>