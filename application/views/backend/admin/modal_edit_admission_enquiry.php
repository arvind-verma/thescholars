<?php
$row = $this->db->get_where('stu_enquiry', array('stu_enquiry_id' => $param2))->row_array();
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

                <?php echo form_open(base_url() . 'admin/admission_enquiry/do_update/' . $row['stu_enquiry_id'] . '/' . $param3, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>


                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                        </div>
                    </div>

                </div>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('father_name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="father_name" value="<?php echo $row['father_name']; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                        </div>
                    </div>

                </div>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date of birth'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control datepicker" name="dob" value="<?php echo $row['dob']; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" data-start-view="2">
                        </div>
                    </div>

                </div>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('gender'); ?></label>
                        <div class="col-sm-5">
                            <select name="gender" class="form-control" required="">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <option value="male" <?php if ($row["gender"] == "male") echo "selected"; ?>><?php echo get_phrase('male'); ?></option>
                                <option value="female" <?php if ($row["gender"] == "female") echo "selected"; ?>><?php echo get_phrase('female'); ?></option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="<?php echo $row['phone']; ?>" name="phone" value="" >
                        </div>
                    </div>

                </div>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>
                        <div class="col-sm-5">
                            <textarea rows="3" class="form-control"  name="address"><?php echo $row['address']; ?></textarea>
                        </div>
                    </div>

                </div>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                        <div class="col-sm-5">
                            <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>"
                                    onchange="return get_class_sections(this.value)">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach ($classes as $row1):
                                    if ($row1["class_id"] == $row["class_id"])
                                        $val = "selected";
                                    else
                                        $val = "";
                                    ?>
                                    <option value="<?php echo $row1['class_id']; ?>" <?php echo $val; ?>>
                                        <?php echo $row1['name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('query'); ?></label>
                        <div class="col-sm-5">
                            <textarea rows="3" class="form-control" name="query"><?php echo $row['query']; ?></textarea>
                        </div>
                    </div>

                </div>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>
                        <div class="col-sm-5">
                            <input type="checkbox" name="status" <?php if($row["status"] == 1) echo "checked";?>/> Approved / Not Approved
                        </div>
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
