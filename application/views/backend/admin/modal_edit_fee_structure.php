<?php
$row1 = $this->db->get_where('fee_structure', array('fee_structure_id' => $param2))->row_array();
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

                <?php echo form_open(base_url() . 'admin/fee_structure/do_update/' . $row1['fee_structure_id'] . '/' . $param3, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                    <div class="col-sm-9">
                        <select name="class_id" class="form-control" style="" required="">
                            <option value="">Select Class</option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                if($row["class_id"] == $row1["class_id"])
                                    $val = "selected";
                                else
                                    $val = "";
                                ?>
                                <option value="<?php echo $row['class_id']; ?>" <?php echo $val;?>><?php echo $row["name"] ?></option>
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
                                if($row["fee_category_id"] == $row1["fee_category_id"])
                                    $val = "selected";
                                else
                                    $val = "";
                                ?>
                                <option value="<?php echo $row['fee_category_id']; ?>" <?php echo $val;?>><?php echo $row["fee_category_name"] ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('amount'); ?></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" value="<?php echo $row1["amount"];?>" name="amount"/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="datepicker form-control" value="<?php echo $row1["date"];?>"  name="date"/>
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
