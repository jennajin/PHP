<div class="col-lg-8 col-lg-offset-2">
    <h3><?php if (@$option == 2) {
            echo "Add";
        } elseif (@$option == 3) {
            echo "Edit";
        } ?> a contact</h3>

    <div class="col-md-12">
        <p class="text-muted"><strong>*</strong> These fields are required.</p>
    </div>

    <form id="contact-form" method="post" action="" role="form" enctype="multipart/form-data">
        <div class="controls">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_ctitle">Title
                            <h7 class="text-muted">*</h7>
                        </label>
                        <input id="form_ctitle" type="text" name="ctitle" class="form-control"
                               value="<?php echo @$ctitle; ?>">
                        <p class="text-danger"><?php echo @$titleErr ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_fname">Firstname
                            <h7 class="text-muted">*</h7>
                        </label>
                        <input id="form_fname" type="text" name="fname" class="form-control"
                               value="<?php echo @$fname; ?>">
                        <p class="text-danger"><?php echo @$fnameErr ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_lname">Lastname
                            <h7 class="text-muted">*</h7>
                        </label>
                        <input id="form_lname" type="text" name="lname" class="form-control"
                               value="<?php echo @$lname; ?>">
                        <p class="text-danger"><?php echo @$lnameErr ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_email">Email</label>
                        <input id="form_email" type="email" name="email" class="form-control"
                               value="<?php echo @$email; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_site">Site</label>
                        <input id="form_site" type="url" name="site" class="form-control" value="<?php echo @$site; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_cellNo">Cell Number</label>
                        <input id="form_cellNo" type="text" name="cellNo" class="form-control" maxlength="10"
                               value="<?php echo @$cellNo; ?>">
                        <p class="text-danger"><?php echo @$cellNoErr ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_homeNo">Home Number</label>
                        <input id="form_homeNo" type="tel" name="homeNo" class="form-control" maxlength="10"
                               value="<?php echo @$homeNo; ?>">
                        <p class="text-danger"><?php echo @$homeNoErr ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_officeNo">Office Number</label>
                        <input id="form_officeNo" type="tel" name="officeNo" class="form-control" maxlength="10"
                               value="<?php echo @$officeNo; ?>">
                        <p class="text-danger"><?php echo @$officeNoErr ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_twitter">Twitter URL</label>
                        <input id="form_twitter" type="url" name="twitter" class="form-control"
                               value="<?php echo @$twitter; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_facebook">Facebook URL</label>
                        <input id="form_facebook" type="url" name="facebook" class="form-control"
                               value="<?php echo @$facebook; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_picture">Picture</label><br>
                        <?php
                        if (@$picture) {
                            echo @$picture;
                        } else {
                            echo "";
                        }
                        ?>
                        <input id='form_picture' type='file' name='picture' accept='.png, .jpg, .jpeg'
                               value="<?php echo @$picture; ?>">
                        <input type='hidden' name='oldPicture' value="<?php echo @$oldPicture; ?>">
                        <p class="text-danger"><?php echo @$pictureErr ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="form_comment">Comment</label>
                        <textarea id="form_comment" name="comment" class="form-control"
                                  rows="4"><?php echo @$comment; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php
                    if (@$option == 2) {
                        echo "<input type='submit' name='add' class='btn btn-success btn-send' value='Add'>";
                    } elseif (@$option == 3) {
                        echo "<input type='submit' name='edit' class='btn btn-success btn-send' value='Edit'>";
                    } ?>
                </div>
            </div>
        </div>
    </form>
</div><!-- /.8 -->

<br>
<a href="vs.php?s=<?php echo __FILE__ ?>" target="_blank" class='btn btn-info'><?php echo basename(__FILE__) ?>
    Source</a>