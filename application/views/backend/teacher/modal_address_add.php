<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_address'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'teacher/student/createadd/' . $param2, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_address'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="student_address" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_city'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="student_city" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_state'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="student_state" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_country'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="student_country" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_pincode'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="student_pincode" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_house_no'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="student_house_no" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_phone'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="student_phone" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-default"><?php echo get_phrase('add'); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>