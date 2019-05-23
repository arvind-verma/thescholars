<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('admission_enquiry'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_admission_enquiry'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>

        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                    <th><div><?php echo get_phrase('name'); ?></div></th>
                    <th><div><?php echo get_phrase('father_name'); ?></div></th>
                    <th><div><?php echo get_phrase('phone'); ?></div></th>
                    <th><div><?php echo get_phrase('query'); ?></div></th>
                    <th><div><?php echo get_phrase('status'); ?></div></th>
                    <th><div><?php echo get_phrase('options'); ?></div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($enquires as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['father_name']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['query']; ?></td>
                                <td><?php
                                    if ($row["status"] == 0) {
                                        ?>
                                        <span class="label label-danger">Not Approved</span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="label label-success">Approved</span>
                                        <?php
                                    }
                                    ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                            <li>
                                                <a href="<?php echo base_url('admin/student_add/'.$row['stu_enquiry_id'])?>" >
                                                    <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('admission'); ?>
                                                </a>
                                            </li>
                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_admission_enquiry/<?php echo $row['stu_enquiry_id']; ?>');">
                                                    <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/admission_enquiry/delete/<?php echo $row['stu_enquiry_id']; ?>');">
                                                    <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'admin/admission_enquiry/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>

                    </div>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('father_name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="father_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>

                    </div>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('date of birth'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control datepicker" name="dob" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" data-start-view="2">
                            </div>
                        </div>

                    </div>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('gender'); ?></label>
                            <div class="col-sm-5">
                                <select name="gender" class="form-control" required="">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <option value="male"><?php echo get_phrase('male'); ?></option>
                                    <option value="female"><?php echo get_phrase('female'); ?></option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="phone" value="" >
                            </div>
                        </div>

                    </div>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>
                            <div class="col-sm-5">
                                <textarea rows="3" class="form-control" name="address"></textarea>
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

                    </div>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('query'); ?></label>
                            <div class="col-sm-5">
                                <textarea rows="3" class="form-control" name="query"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_enquiry'); ?></button>
                        </div>
                    </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
        </div>
    </div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function($)
    {


        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>