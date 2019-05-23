<?php
$edit_data = $this->db->get_where('student', array('student_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_student'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'admin/student/' . $row['class_id'] . '/do_update/' . $row['student_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>



                    <div class="form-group">
                        <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('photo'); ?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('aadhar_card_no'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="aadhar_card_no" value="<?php echo $row['aadhar_card_no']; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('admission_no'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="admission_no" value="<?php echo $row['admission_no']; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('title'); ?></label>

                        <div class="col-sm-5">
                            <select class="form-control" required="" name="title">
                                <option value="">Select Title</option>
                                <option <?php if ($row["title"] == "Mr.") echo "selected"; ?> >Mr.</option>
                                <option <?php if ($row["title"] == "Mrs.") echo "selected"; ?>>Mrs.</option>
                                <option <?php if ($row["title"] == "Ms.") echo "selected"; ?>>Ms.</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $row['name']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-5">
                            <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>"
                                    onchange="return get_class_sections(this.value)">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach ($classes as $row2):
                                    ?>
                                    <option value="<?php echo $row2['class_id']; ?>"
                                            <?php if ($row['class_id'] == $row2['class_id']) echo 'selected'; ?>>
                                                <?php echo $row2['name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>


                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('section'); ?></label>
                        <div class="col-sm-5">
                            <select name="section_id" class="form-control" id="section_selector_holder">
                                <option value=""><?php echo get_phrase('select_class_first'); ?></option>
                                <?php
                                $sections = $this->db->get_where('section', array("class_id" => $row['class_id']))->result_array();
                                foreach ($sections as $row4):
                                    ?>
                                    <option value="<?php echo $row4['section_id']; ?>"
                                            <?php if ($row4['section_id'] == $row['section_id']) echo 'selected'; ?>>
                                                <?php echo $row4['name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('batch_name'); ?></label>

                        <div class="col-sm-5">
                            <select name="batch_id" class="form-control" data-validate="required" id="batch_id" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>"
                                    onchange="return get_class_sections(this.value)">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $classes = $this->db->get('batch')->result_array();
                                foreach ($classes as $row5):
                                    ?>
                                    <option value="<?php echo $row5['batch_id']; ?>" <?php if ($row5["batch_id"] == $row["batch_id"]) echo "selected"; ?>>
                                        <?php echo $row5['batch_name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('roll'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="roll" value="<?php echo $row['roll']; ?>" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('birthday'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control datepicker" name="birthday" value="<?php echo $row['birthday']; ?>" data-start-view="2">
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('gender'); ?></label>

                        <div class="col-sm-5">
                            <select name="sex" class="form-control">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <option value="male" <?php if ($row['sex'] == 'male') echo 'selected'; ?>><?php echo get_phrase('male'); ?></option>
                                <option value="female"<?php if ($row['sex'] == 'female') echo 'selected'; ?>><?php echo get_phrase('female'); ?></option>
                            </select>
                        </div> 
                    </div>



                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('phone'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('email'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('password'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="password" value="<?php echo $row['password']; ?>">
                        </div>
                    </div>
                    <h4 align="center">Hostel : -</h4>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('select_hostel'); ?></label>

                        <div class="col-sm-5">
                            <select name="dormitory_id" class="form-control">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $hostels = $this->db->get('dormitory')->result_array();
                                foreach ($hostels as $row1):
                                    if ($row1["dormitory_id"] == $row["dormitory_id"])
                                        $val = "selected";
                                    else
                                        $val = "";
                                    ?>
                                    <option value="<?php echo $row1['dormitory_id']; ?>" <?php echo $val; ?>>
                                        <?php echo $row1['name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>
                    <h4 align="center">Transport : -</h4>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('select_route'); ?></label>

                        <div class="col-sm-5">
                            <select name="transport_id" id="transport_id" class="form-control" onchange="get_vehicle_route(this.value)">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $parents = $this->db->get('transport')->result_array();
                                foreach ($parents as $row2):
                                    if ($row2["transport_id"] == $row["transport_id"])
                                        $val = "selected";
                                    else
                                        $val = "";
                                    ?>
                                    <option value="<?php echo $row2['transport_id']; ?>" <?php echo $val; ?>>
                                        <?php echo $row2['route_name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-5 control-label"><?php echo get_phrase('select_vehicle'); ?></label>

                        <div class="col-sm-5">
                            <select name="vehicle_id" class="form-control" id="vehicle_id">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $vehicles = $this->db->get_where('vehicle_detail', array("vehicle_id" => $row['vehicle_id']))->result_array();
                                foreach ($vehicles as $row7):
                                    ?>
                                    <option value="<?php echo $row7['vehicle_id']; ?>"
                                            <?php if ($row7['vehicle_id'] == $row['vehicle_id']) echo 'selected'; ?>>
                                                <?php echo $row7['vehicle_name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>
                  
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php
endforeach;
?>

<script type="text/javascript">



    var class_id = $("#class_id").val();

    $.ajax({
        url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
        success: function(response)
        {
            jQuery('#section_selector_holder').html(response);
        }
    });

    var transport_id = $("#transport_id").val();

    $.ajax({
        url: '<?php echo base_url(); ?>admin/get_vehicle_route/' + transport_id,
        success: function(response)
        {
            jQuery('#vehicle_id').html(response);
        }
    });

</script>