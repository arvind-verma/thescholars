<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('addmission_form'); ?>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'teacher/student/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                <div class="panel panel-info">
                    <div class="panel-heading"> <i class="fa fa-info-circle"></i> Personal Details</div>
                    <div class="panel-body">
                        <div>
                            <div class="col-md-4 pull-left">
                                <div class="form-group">
                                    <label>
                                        <?php echo get_phrase('admission_no'); ?>
                                    </label>
                                    <input type="text" class="form-control" name="admission_no" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="2K<?php echo date("y");?>-<?php echo $total_students;?>" autofocus>
                                    <br clear="all"/>
                                    <label>
                                        <?php echo get_phrase('title'); ?>
                                    </label>
                                    <select class="form-control" required="" name="title">
                                        <option value="">Select Title</option>
                                        <option>Mr.</option>
                                        <option>Mrs.</option>
                                        <option>Ms.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 pull-right">
                                <div class="form-group">
                                    <label style="vertical-align:top;">Upload Image : </label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="http://placehold.it/200x200" alt="...">
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
                        </div><br clear="all"/>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo get_phrase('student_name'); ?></label>
                                <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>

                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>
                                    <?php echo get_phrase('aadhar_card_no'); ?>
                                </label>
                                <input type="text" class="form-control" name="aadhar_card_no" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> <?php echo get_phrase('date of birth'); ?> </label>
                                <input type="text" class="form-control datepicker" name="birthday" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" data-start-view="2">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo get_phrase('gender'); ?> </label>
                                <select name="sex" class="form-control" required="">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <option value="male"><?php echo get_phrase('male'); ?></option>
                                    <option value="female"><?php echo get_phrase('female'); ?></option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> <?php echo get_phrase('phone'); ?></label>
                                <input type="text" class="form-control" name="phone" value="" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> <?php echo get_phrase('religion'); ?></label>
                                <input type="text" class="form-control" name="religion" value="" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo get_phrase('email'); ?></label>
                                <input type="text" class="form-control" name="email" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading"> <i class="fa fa-info-circle"></i> Academic Details</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> <?php echo get_phrase('class'); ?></label>
                                <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                        data-message-required="<?php echo get_phrase('value_required'); ?>"
                                        onchange="return get_class_sections(this.value)">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <?php
                                    $classes = $this->db->get('class')->result_array();
                                    foreach ($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['class_id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> <?php echo get_phrase('section'); ?></label>
                                <select name="section_id" class="form-control" data-validate="required" id="section_selector_holder">
                                    <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo get_phrase('batch_name'); ?> </label>
                                <select name="batch_id" class="form-control" data-validate="required" id="batch_id" 
                                        data-message-required="<?php echo get_phrase('value_required'); ?>"
                                        onchange="return get_class_sections(this.value)">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <?php
                                    $classes = $this->db->get('batch')->result_array();
                                    foreach ($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['batch_id']; ?>" <?php if ($row["current_batch"] == 1) echo "selected"; ?>>
                                            <?php echo $row['batch_name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="panel panel-info">
                    <div class="panel-heading"> <i class="fa fa-info-circle"></i> More Details</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo get_phrase('select_hostel'); ?></label>
                                <select name="dormitory_id" class="form-control">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <?php
                                    $parents = $this->db->get('dormitory')->result_array();
                                    foreach ($parents as $row):
                                        ?>
                                        <option value="<?php echo $row['dormitory_id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo get_phrase('select_route'); ?></label>
                                <select name="transport_id" class="form-control" onchange="get_vehicle_route(this.value)">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <?php
                                    $parents = $this->db->get('transport')->result_array();
                                    foreach ($parents as $row):
                                        ?>
                                        <option value="<?php echo $row['transport_id']; ?>">
                                            <?php echo $row['route_name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo get_phrase('select_vehicle'); ?></label>
                                <select name="vehicle_id" class="form-control" id="vehicle_id">
                                    <option value=""><?php echo get_phrase('select'); ?></option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="reset" class="btn btn-default"><?php echo get_phrase('reset'); ?></button>
                    <button type="submit" class="btn btn-info"><?php echo get_phrase('add_student'); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }
    function get_vehicle_route(route_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_vehicle_route/' + route_id,
            success: function(response)
            {
                jQuery('#vehicle_id').html(response);
            }
        });

    }

</script>