<?php
$edit_data = $this->db->get_where('tasks', array('task_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_task'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'teacher/tasks/do_update/'.$row['task_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                  
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('task_name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="task_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $row['task_name']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_task'); ?></button>
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

    function get_class_sections(class_id) {
        alert(class_id);
        $.ajax({
            url: '<?php echo base_url(); ?>teacher/get_class_section/' + class_id,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

    var class_id = $("#class_id").val();

    $.ajax({
        url: '<?php echo base_url(); ?>teacher/get_class_section/' + class_id,
        success: function(response)
        {
            jQuery('#section_selector_holder').html(response);
        }
    });


</script>