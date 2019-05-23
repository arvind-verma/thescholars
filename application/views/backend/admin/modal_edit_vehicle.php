<?php 
$edit_data		=	$this->db->get_where('vehicle_detail' , array('vehicle_id' => $param2) )->result_array();

?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'admin/vehicle_detail/do_update/'.$row['vehicle_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                
                <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_route'); ?></label>

                        <div class="col-sm-5">
                            <select name="transport_id" class="form-control">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $transports = $this->db->get('transport')->result_array();
                                foreach ($transports as $row1):
                                    if($row1["transport_id"] == $row["driver_id"])
                                        $val = "selected";
                                    else
                                        $val = "";
                                    ?>
                                    <option value="<?php echo $row1['transport_id']; ?>" <?php echo $val;?>>
                                    <?php echo $row1['route_name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_driver'); ?></label>

                        <div class="col-sm-5">
                            <select name="driver_id" class="form-control">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $drivers = $this->db->get('driver_detail')->result_array();
                                foreach ($drivers as $row2):
                                    if($row2["driver_id"] == $row["driver_id"])
                                        $val = "selected";
                                    else
                                        $val = "";
                                    ?>
                                    <option value="<?php echo $row2['driver_id']; ?>" <?php echo $val;?>>
                                    <?php echo $row2['driver_name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="vehicle_name" value="<?php echo $row['vehicle_name'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle_no');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="vehicle_no" value="<?php echo $row['vehicle_no'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('seats');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="seats" value="<?php echo $row['seats'];?>"/>
                    </div>
                </div>
                
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_vehicle');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>