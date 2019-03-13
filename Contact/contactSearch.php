<?php $returnValue = isset($returnValue) ? $returnValue : 1; ?>

<div class="col-md-5">
    <h3>Enter First name or Last name.</h3>
    <form class="navbar-form" method="post" action="">
        <div class="input-group">
            <input type="text" class="form-control" name="searchName" required>
            <span class="input-group-btn">
                <input type="submit" class="btn btn-secondary" name="search" value="Search">
            </span>
        </div>
    </form>
</div>

<?php
if ($returnValue && isset($_GET['index'])) {
    include "searchResult.php";
} elseif (!$returnValue) {
    echo "<div class='col-md-5'>
              <div class='alert alert-danger'>
                  <a class='panel-close close' data-dismiss='alert'>×</a>
                  No contacts found.
              </div>
           </div>";
}
?>

<a href="vs.php?s=<?php echo __FILE__ ?>" target="_blank" class='btn btn-info'><?php echo basename(__FILE__) ?>Source</a>