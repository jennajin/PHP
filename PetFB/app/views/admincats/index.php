<?php require APPLICATION_ROOT . '/views/include/header.php'?>


<!-- JAVASCRIPT to clear search text when the field is clicked -->
<script type="text/javascript">
    window.onload = function(){
        //Get submit button
        var submitbutton = document.getElementById("searchform");
        //Add listener to submit button
        if(submitbutton.addEventListener){
            submitbutton.addEventListener("click", function() {
                if (submitbutton.value == 'Enter Cat Name'){//Customize this text string to whatever you want
                    submitbutton.value = '';
                }
            });
        }
    }
</script>
<div class="col-md-8 mx-auto">
    <div class="card card-body bg-light mt-5">
        <?php messageBox('admuser_message'); ?>
        <h2>Cat Information</h2>
        <br><br>
        <div class="row">
        <form id="usersearch" action="<?php echo URL_ROOT;?>/admincats/show" method="post" >
            <div class="input-group">
            <input type="text" id="searchform" name="search" size="21" maxlength="120" class="form-control ml-3" value="Enter Cat Name">
            <span class="input-group-btn">
                <input type="submit" value="Search" class="btn btn-primary ">
            </span>
            </div>
        </form>
        </div>
        <br>
            <table class="table table-striped table-hover">

                <tr>
                    <th>Owner ID</th>
                    <th>Owner Name</th>
                    <th>Cat Name</th>
                    <th colspan="2" class="text-center">Action</th>
                </tr>
                <tbody>
                <?php foreach($data['cats'] as $cat): ?>
                    <tr>
                        <!--Each table column is echoed in to a td cell-->
                        <td><?php echo $cat->userId  ?></td>
                        <td><?php echo $cat->userName ?></td>
                        <td><?php echo $cat->catName ?></td>
                        <td> <a href="<?php echo URL_ROOT; ?>/admincats/edit/<?php echo $cat->userId; ?>" class ="btn btn-warning" > edit </a>
                        </td>
                        <td>
                            <form class="pull-right" action="<?php echo URL_ROOT; ?>/admincats/delete/<?php echo $cat->userId; ?>" method="post">
                                <input type="submit" value="Delete"  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete it?');">
                            </form></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

    </div>
</div>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>

