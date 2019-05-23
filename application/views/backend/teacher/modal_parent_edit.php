<?php
$row = $this->db->get_where('parent', array('parent_id' => $param2))->row_array();
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_parent'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'teacher/parent/edit/' . $row['parent_id'] . '/' . $param3, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('father_name'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="father_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"
                               value="<?php echo $row['father_name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('father_phone'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="father_phone" value="<?php echo $row['father_phone']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('father_occupation'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="father_occupation" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"
                               value="<?php echo $row['father_occupation']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('father_aadhar_card'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="father_aadhar_card" 
                               value="<?php echo $row['father_aadhar_card']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('mother_name'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mother_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"
                               value="<?php echo $row['mother_name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('mother_phone'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mother_phone" value="<?php echo $row['mother_phone']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('mother_occupation'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mother_occupation" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"
                               value="<?php echo $row['mother_occupation']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('mother_aadhar_card'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mother_aadhar_card"
                               value="<?php echo $row['mother_aadhar_card']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('email'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" 
                               value="<?php echo $row['email']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('profession'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="profession" value="<?php echo $row['profession']; ?>">
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
