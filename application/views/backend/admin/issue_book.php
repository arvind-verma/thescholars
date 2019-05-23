
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('issue_book_list'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_issue_book'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>


        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                    <th><div><?php echo get_phrase('barcode_no'); ?></div></th>
                <th><div><?php echo get_phrase('user_id'); ?></div></th>
                    <th><div><?php echo get_phrase('start_date'); ?></div></th>
                    <th><div><?php echo get_phrase('end_date'); ?></div></th>
                    <th><div><?php echo get_phrase('options'); ?></div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($issue_books as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['barcode_no']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['start_date']; ?></td>
                                <td><?php echo $row['end_date']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                           
                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/issue_book/delete/<?php echo $row['issue_book_id']; ?>');">
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
                    <?php echo form_open(base_url() . 'admin/issue_book/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('barcode_no'); ?>/<?php echo get_phrase('book_no'); ?></label>
                        <div class="col-sm-5">
                         
                                <select class="select2 form-control" name="barcode_no">
                                <?php
                                $books = $this->db->get('book')->result_array();
                                foreach ($books as $row2):
                                    ?>
                                    <option value="<?php echo $row2['barcode_no']; ?>"><?php echo $row2['barcode_no']; ?> - <?php echo $row2['name']; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('user_type'); ?></label>
                        <div class="col-sm-5">
                            <select name="user_type" class="form-control" style="width:100%;">
                                <option value="student"><?php echo get_phrase('student'); ?></option>
                                <option value="teacher"><?php echo get_phrase('teacher'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('user_id'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" required="" name="user_id" placeholder="Student Id/Teacher Id" />
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('start_date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" id="datepicker" required="" class="datepicker fill-up form-control" date-format="yyyy-mm-dd" name="start_date" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('end_date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" id="datepicker1" required="" class="datepicker fill-up form-control"  name="end_date"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('issue_book'); ?></button>
                        </div>
                    </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS--->

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