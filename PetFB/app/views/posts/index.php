<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<?php messageBox('post_message'); ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URL_ROOT; ?>/posts/add" class="btn btn-primary pull-right">
                <i class = "fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>
 <?php foreach ($data['posts'] as $post) :?>
     <div class="card card-body mb-3">
         <h4 class="card-title"><?php echo $post->title ?> </h4>

         <div class="bg-light p-2 mb-3">
             Written by <?php echo $post->userName; ?> on <?php echo $post->postCreated; ?>
         </div>
         <p class="card-text">
             <?php
             $real_picture =  URL_ROOT.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.'user'.
                 $post->userId .DIRECTORY_SEPARATOR.'posts'. DIRECTORY_SEPARATOR.$post->picture;
             if($post->picture){
                 echo '<img src="'.$real_picture.'" class=\'img-thumbnail\' alt=\"my_post\"/>';
             } else{
                 echo "";
             }
             ?>
         </p>
         <p class="card-text">
             <?php echo $post->body; ?>
         </p>
         <a href="<?php echo URL_ROOT;?>/posts/show/<?php echo $post->postId;?>"
            class="btn btn-secondary">More</a>
  </div>
 <?php endforeach; ?>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>
