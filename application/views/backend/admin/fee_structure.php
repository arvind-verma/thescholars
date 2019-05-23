<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('fee_structure'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_fee_structure'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table  class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                    <th><div><?php echo get_phrase('class'); ?></div></th>
                    <th><div><?php echo get_phrase('fee_category'); ?></div></th>
                    <th><div><?php echo get_phrase('amount'); ?></div></th>
                    <th><div><?php echo get_phrase('created'); ?></div></th>

                    <th><div><?php echo get_phrase('options'); ?></div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($structures as $row):
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $this->crud_model->get_class_name($row['class_id']); ?></td>
                                <td><?php echo $this->crud_model->get_fee_category_name($row['fee_category_id']); ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['created']; ?></td>


                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">


                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_fee_structure/<?php echo $row['fee_structure_id']; ?>');">
                                                    <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/fee_structure/delete/<?php echo $row['fee_structure_id']; ?>');">
                                                    <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $count++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <?php echo form_open(base_url() . 'admin/fee_structure/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo get_phrase('fee_structure'); ?></div>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                                    <div class="col-sm-9">
                                        <select name="class_id" class="form-control" style="" required="">
                                            <option value="">Select Class</option>
                                            <?php
                                            $classes = $this->db->get('class')->result_array();
                                            foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row["name"] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('fee_category'); ?></label>
                                    <div class="col-sm-9">
                                        <select name="fee_category_id" class="form-control" style="" required="">
                                            <option value=""><?php echo get_phrase('select_fee_category'); ?></option>
                                            <?php
                                            $fee_categories = $this->db->get('fee_category')->result_array();
                                            foreach ($fee_categories as $row):
                                                ?>
                                                <option value="<?php echo $row['fee_category_id']; ?>"><?php echo $row["fee_category_name"] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('amount'); ?></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="amount"/>
                                    </div>
                                </div>
                              

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="datepicker form-control" name="date"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <button type="submit" class="btn btn-info"><?php echo get_phrase('add_invoice'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php echo form_close(); ?>
            </div>
            <!----CREATION FORM ENDS-->

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });
    });
</script>