<div class="card">
    <div class="card-header white-text">
        Contact Information
    </div>

    <div class="card-body">
        <div class='row'>
            <!-- left column: a picture -->
            <div class='col-md-4 col-sm-6 col-xs-12'>
                <div class='text-center'>
                    <?php if (@$picture && file_exists('img/' . @$picture)) {
                        echo "<img src='img/" . @$picture . "' class='img-thumbnail' alt='contact_picture'>";
                    } else {
                        echo "";
                    } ?>
                </div>
            </div>

            <!-- right column: contact details -->
            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Title</label><?php echo @$ctitle; ?>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">First Name</label><?php echo @$fname; ?>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Last Name</label><?php echo @$lname; ?>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email</label><a
                            href="mailto:<?php echo @$email; ?>"><?php echo @$email; ?></a>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Site</label><a href="<?php echo @$site; ?>"
                                                                         target="_blank"><?php echo @$site; ?></a>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Cell number</label><?php echo @$cellNo; ?>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Home number</label><?php echo @$homeNo; ?>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Office number</label><?php echo @$officeNo; ?>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Twitter</label><a href="<?php echo @$twitter; ?>"
                                                                            target="_blank"><?php echo @$twitter; ?></a>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Facebook</label><a href="<?php echo @$facebook; ?>"
                                                                             target="_blank"><?php echo @$facebook; ?></a>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Comment</label><?php echo @$comment; ?>
                </div>
            </div>  <!-- /right column -->
        </div> <!-- /rwo -->
    </div> <!-- /card body -->
</div> <!-- /card -->

<br>
<a href="vs.php?s=<?php echo __FILE__ ?>" target="_blank" class='btn btn-info'><?php echo basename(__FILE__) ?>Source</a>



