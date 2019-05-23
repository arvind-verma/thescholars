<?php 
$edit_data		=	$this->db->get_where('dormitory' , array('dormitory_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'admin/dormitory/do_update/'.$row['dormitory_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_guardian'); ?></label>

                        <div class="col-sm-5">
                            <select name="guardian_id" class="form-control">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $guardians = $this->db->get('guardian_detail')->result_array();
                                foreach ($guardians as $row1):
                                    if($row1["guardian_id"] == $row["guardian_id"])
                                        $val ="selected";
                                    else
                                        $val ="";
                                    ?>
                                    <option value="<?php echo $row['guardian_id']; ?>" <?php echo $val;?>>
                                    <?php echo $row['guardian_name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('dormitory_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_room');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="number_of_room" value="<?php echo $row['number_of_room'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_dormitory');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>