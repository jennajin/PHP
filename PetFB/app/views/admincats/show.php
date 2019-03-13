<?php require APPLICATION_ROOT . '/views/include/header.php'?>

<div class="col-md-8 mx-auto">
    <div class="card card-body bg-light mt-5">
        <h2>Cat Information</h2>
        <br>
        <table class="table table-striped table-hover">
            <tr>
                <th>Owner ID</th>
                <th>Owner Name</th>
                <th>Cat Name</th>
                <th colspan="2" class="text-center">Action</th>
            </tr>
            <tbody>
            <tr>
                <!--Each table column is echoed in to a td cell-->
                <td><?php echo isset($data['cat']->userId)? $data['cat']->userId:' no userId' ?></td> <!--has to be #data[cat]-->
                <td><?php echo isset($data['user']->userName)?$data['user']->userName:" no userName" ?></td>
                <td><?php echo isset($data['cat']->catName)?$data['cat']->catName:" no catName" ?></td>
                <td>
                    <form class="pull-right" action="<?php echo URL_ROOT; ?>/admincats/edit/<?php echo $data['cat']->userId; ?>" method="post">
                        <input type="submit" value="Edit"  class="btn btn-warning">
                    </form>
                </td>
                <td>
                    <form class="pull-right" action="<?php echo URL_ROOT; ?>/admincats/delete/<?php echo $data['cat']->userId; ?>" method="post">
                        <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete it?');">
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php require APPLICATION_ROOT . '/views/include/footer.php'?>

