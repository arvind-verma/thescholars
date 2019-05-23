<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('promote_class'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'admin/promote_class_action/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>


                <div class="col-md-6">
                    <h3>Old Class</h3>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-8">
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

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section'); ?></label>
                        <div class="col-sm-8">
                            <select name="section_id" class="form-control" id="section_selector_holder" data-validate="required">
                                <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('batch_name'); ?></label>

                        <div class="col-sm-8">
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
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="button" id="load_students" class="btn btn-danger"><?php echo get_phrase('load_students'); ?></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h3>New Class</h3>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-8">
                            <select name="new_class_id" class="form-control" data-validate="required" id="class_id1" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>"
                                    onchange="return get_class_sections1(this.value)">
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

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section'); ?></label>
                        <div class="col-sm-8">
                            <select name="new_section_id" class="form-control" id="section_selector_holder1">
                                <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('batch_name'); ?></label>

                        <div class="col-sm-8">
                            <select name="new_batch_id" class="form-control" data-validate="required" id="batch_id1" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>">
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
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_student'); ?></button>
                        </div>
                    </div>
                </div>

                <br clear="all"/>

                <div id="student_data"class="col-md-6">

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
    function get_class_sections1(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
            success: function(response)
            {
                jQuery('#section_selector_holder1').html(response);
            }
        });

    }

    $(document).ready(function() {

        $("#load_students").click(function() {

            $.ajax({
                url: "<?php echo base_url(); ?>admin/getStudentsByBatch",
                type: 'get',
                data: 'class_id=' + $("#class_id").val() + "&section_id=" + $("#section_selector_holder").val() + "&batch_id=" + $("#batch_id").val(),
                dataType: 'json',
                beforeSend: function() {
                    $("#loading-image").show();
                },
                complete: function()
                {
                    $("#loading-image").hide();
                },
                success: function(result) {

                    var txt = "";
                    if (result.length > 0)
                    {                        
                        txt += "<table class='table table-bordered table-striped'>";
                        txt += "<tr><th>#</th><th>Status</th><th>Student Name</th><th>Father Name</th></tr>";
                        for (i = 0; i < result.length; i++)
                        {
                            txt += "<tr><td>"+(i+1)+"</td><td><input type='checkbox' name='student_ids[]' value='" + result[i].student_id + "' checked> </td><td>" + result[i].name + "</td><td>"+result[i].father_name+"</td></tr>";
                        }
                        txt += "</table";
                    }
                    else
                    {
                        txt = "";
                    }
                    $("#student_data").html(txt);
                    txt = "";
                }
            });
        });
    });
</script>