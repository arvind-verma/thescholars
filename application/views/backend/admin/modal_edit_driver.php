<?php 
$edit_data		=	$this->db->get_where('driver_detail' , array('driver_id' => $param2) )->result_array();

?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'admin/driver_detail/do_update/'.$row['driver_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('driver_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="driver_name" value="<?php echo $row['driver_name'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                    </div>
                </div>
                
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_driver');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>