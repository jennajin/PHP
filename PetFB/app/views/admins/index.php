<?php require APPLICATION_ROOT . '/views/include/header.php'?>
<?php messageBox('admuser_message'); ?>
<div class="row mb-3">
    <div class="col-xs-3">
        <h1>Info</h1>
    </div>
</div>
<div class="container card card-body mb-3">
<div class = "row">
    <!----------------------Genders column---------->
        <div class="col-sm-4">
        <table class="table table-striped table-hover">
                <h3>Gender</h3>
        <p><a href="<?php echo URL_ROOT; ?>/admins/addGender"  class="btn btn-primary pull-left">
                <i class = "fa fa-pencil"></i> Add Gender
            </a></p>
            <tbody>
            <?php foreach($data['genders'] as $gender): ?>
                <tr>
                    <!--Each table column is echoed in to a td cell-->
                    <td><?php echo $gender->gender  ?></td>
                    <td><a href="<?php echo URL_ROOT; ?>/admins/edit/<?php echo $gender->genderId; ?>" class="btn btn-warning">Edit</</a></td>
                    <td><form class="pull-right" action="<?php echo URL_ROOT; ?>/admins/delete/<?php echo $gender->genderId;?>" method="post">
                            <input type="submit" value="Delete" name="deleteGender"  class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete it?');">
                        </form></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
</div>
<br>
    <!-----------------------Colors column---------->
<div class="col-sm-4">
          <table class="table table-striped table-hover">
               <h3>Colors</h3>
            <p><a href="<?php echo URL_ROOT; ?>/admins/addColor" id="addColor" class="btn btn-primary pull-left">
                  <i class = "fa fa-pencil"></i> Add Color
                </a>  </p>

               <tbody>
                <?php foreach($data['colors'] as $color): ?>
                    <tr>
                        <!--Each table column is echoed in to a td cell-->
                        <td><?php echo $color->color ?></td>
                        <td><a href="<?php echo URL_ROOT; ?>/admins/editColor/<?php echo $color->colorId; ?>" class="btn btn-warning">Edit</a></td>
                        <td><form class="pull-right" action="<?php echo URL_ROOT; ?>/admins/delete/<?php echo $color->colorId;?>" method="post">
                                <input type="submit" value="Delete"  name="deleteColor"  class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete it?');">
                            </form></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

</div>
<br>
    <!-----------------------Breeds column---------->
<div class="col-sm-4">
        <table class="table table-striped table-hover">
            <h3>Breeds</h3>
          <p><a href="<?php echo URL_ROOT; ?>/admins/addBreed" class="btn btn-primary pull-left">
                <i class = "fa fa-pencil"></i> Add Breed
              </a></p>
        <tbody>
        <?php foreach($data['breeds'] as $breed): ?>
            <tr>
                <!--Each table column is echoed in to a td cell-->
                <td><?php echo $breed->breed ?></td>
                <td><a href="<?php echo URL_ROOT; ?>/admins/editBreed/<?php echo $breed->breedId; ?>" class="btn btn-warning">Edit</a></td>
                <td><form class="pull-right" action="<?php echo URL_ROOT; ?>/admins/delete/<?php echo $breed->breedId;?>" method="post">
                        <input type="submit" value="Delete" name="deleteBreed"   class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete it?');">
                    </form></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
</div>
    <div class = "row">
        <!------------------------Provinces column---------->
    <div class="col-sm-6">
                <table class="table table-striped table-hover">
                <h3>Provinces</h3>
                    <p><a href="<?php echo URL_ROOT; ?>/admins/addProvince" class="btn btn-primary pull-left">
                            <i class = "fa fa-pencil"></i> Add Province
                        </a>  </p>
                    <th>Province ID</th>
                    <th>Province Name</th>
                    <th>Action</th>
                    <th>Action</th>

                    <tbody>
                <?php foreach($data['provinces'] as $province): ?>

                    <tr>
                    <!--Each table column is echoed in to a td cell-->

                    <td><?php echo $province->provinceId ?></td>
                    <td><?php echo $province->province ?></td>
                    <td><a href="<?php echo URL_ROOT; ?>/admins/editProvince/<?php echo $province->provinceId; ?>" class="btn btn-warning">Edit</a></td>
                    <td><form class="pull-right" action="<?php echo URL_ROOT; ?>/admins/delete/<?php echo $province->provinceId;?>" method="post">
                            <input type="submit" value="Delete"  name="deleteProvince"   class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete it?');">



                        </form></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</div>

    <!------------------------Cities column---------->
    <div class="col-sm-6">
        <table class="table table-striped table-hover" id="cityTable">
            <h3>Cities</h3>
            <p><a href="<?php echo URL_ROOT; ?>/admins/addCity" class="btn btn-primary pull-left">
                    <i class = "fa fa-pencil"></i> Add City
                </a>  </p>
            <th>City</th>
            <th>Province ID</th>
            <th>Action</th>
            <th>Action</th>
            <tbody>
                       <?php foreach($data['cities'] as $city): ?>
                <tr>

                    <!--Each table column is echoed in to a td cell-->
                    <td><?php echo $city->city ?></td>
                    <td><?php echo $city->provinceId ?></td>
                    <td><a href="<?php echo URL_ROOT; ?>/admins/editCity/<?php echo $city->cityId; ?>" class="btn btn-warning">Edit</a></td>
                    <td><form class="pull-right" action="<?php echo URL_ROOT; ?>/admins/delete/<?php echo $city->cityId;?>" method="post">
                            <input type="submit" value="Delete"  name="deleteCity"   class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete it?');">

                        </form></td>

                </tr>
                       <?php endforeach; ?>
            </tbody>
    </table>
    </div>
    </div>
    </div>
    <?php require APPLICATION_ROOT . '/views/include/footer.php'?>
