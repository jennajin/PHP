<?php require APPLICATION_ROOT . '/views/include/header.php'?>
    <div class="col-md-8 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>User Information</h2>
            <br>
            <table class="table table-striped table-hover">

                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Cat Name</th>
                    <th colspan="2" class="text-center">Action</th>

                </tr>
                <tbody>

                    <tr>
                        <!--Each table column is echoed in to a td cell-->
                        <td><?php echo isset($data['user']->userId)? $data['user']->userId:"userId not found" ?></td>
                        <td><?php echo isset($data['user']->userName) ?$data['user']->userName:"user not found" ?></td>
                        <td><?php echo isset($data['cat']->catName)?$data['cat']->catName:"no cat" ?></td> <!--here was 'user'-->
                        <td><a href="<?php echo URL_ROOT; ?>/adminusers/edit/<?php echo $data['user']->userId; ?>" class ="btn btn-warning"> edit </a></td>
                          </td>
                        <td>
                            <form class="pull-right" action="<?php echo URL_ROOT; ?>/adminusers/delete/<?php echo $user->userId; ?>" method="post">
                                <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete it?');">
                            </form></td>
                    </tr>
                </tbody>
            </table>
    </div>
</div>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>