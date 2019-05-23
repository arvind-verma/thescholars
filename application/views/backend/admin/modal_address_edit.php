<?php
$row = $this->db->get_where('stu_address', array('stu_add_id' => $param2))->row_array();
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_address'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'admin/student/editadd/' . $row['stu_add_id'] . '/' . $param3, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>


                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_address'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?php echo $row['stu_add']; ?>" name="student_address" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_city'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?php echo $row['stu_add_city']; ?>" name="student_city" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_state'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?php echo $row['stu_add_state']; ?>" name="student_state" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_country'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?php echo $row['stu_add_country']; ?>" name="student_country" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_pincode'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?php echo $row['stu_add_pincode']; ?>" name="student_pincode" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_house_no'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?php echo $row['stu_add_house_no']; ?>" name="student_house_no" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('student_phone'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?php echo $row['stu_add_phone_no']; ?>" name="student_phone" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-default"><?php echo get_phrase('update'); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
