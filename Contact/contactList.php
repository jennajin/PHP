<div class='table_div'>
    <table class='table table-hover'>
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Picture</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($x = 0; $x < sizeof(@$list); $x++) {
            @$data = explode(",", trim(@$list[$x]));
            @$fname = isset($data[1]) ? $data[1] : null;
            @$lname = isset($data[2]) ? $data[2] : null;
            @$picture = isset($data[10]) ? $data[10] : null;
            echo "<tr>
                    <th>" . @$fname . "</th>
                    <th>" . @$lname . "</th>
                    <th>";
            if (@$picture && file_exists('img/' . @$picture)) {
                echo "<img src=img/" . @$picture . " class='sImg'>";
            } else {
                echo "";
            }
            echo "</th>
                    <th><a href='?option=3&index=" . @$x . "' class='btn btn-primary'>Edit</a></th>
                    <th><a href='?option=4&index=" . @$x . "' class='btn btn-danger' onclick='return deleteConfirm()'>Delete</a></th>
                </tr>";
        } ?>
        </tbody>
    </table>
</div>

<br>
<a href="vs.php?s=<?php echo __FILE__ ?>" target="_blank" class='btn btn-info'><?php echo basename(__FILE__) ?>
    Source</a>