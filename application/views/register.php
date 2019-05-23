<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Student Registration Form</title>
<?php
$text_align="";
include("backend/includes_top.php");
?>
    </head>
    <body style="background:url('<?php echo base_url();?>campus.jpg');background-size:cover;background-attachment:fixed;">
        <div class="container">
           
            <header>
                <h1 align="center" style="color:white;">Student Registration Form</h1>
				
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
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

                <?php echo form_open(base_url() . 'register/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

               <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar_card_no'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="aadhar_card_no" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>
<div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_name'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="father_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>
				<div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_name'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mother_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>
               

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

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

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section'); ?></label>
                    <div class="col-sm-5">
                        <select name="section_id" data-validate="required" class="form-control" id="section_selector_holder">
                            <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('session'); ?></label>

                    <div class="col-sm-5">
                        <select name="batch_id" class="form-control" data-validate="required" readonly="true" id="batch_id" 
                                data-message-required="<?php echo get_phrase('value_required'); ?>"
                                onchange="return get_class_sections(this.value)">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <?php
                            $classes = $this->db->get('batch')->result_array();
                            foreach ($classes as $row):
							if($row["current_batch"] == 1)
							{
                                ?>
                                <option value="<?php echo $row['batch_id']; ?>" <?php if($row["current_batch"] == 1) echo "selected";?>>
                                    <?php echo $row['batch_name']; ?>
                                </option>
                                <?php
							}
                            endforeach;
                            ?>
                        </select>
                    </div> 
                </div>
              

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dob'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender'); ?></label>

                    <div class="col-sm-5">
                        <select name="sex" class="form-control">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <option value="male"><?php echo get_phrase('male'); ?></option>
                            <option value="female"><?php echo get_phrase('female'); ?></option>
                        </select>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" value="" >
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone" value="" >
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" value="">
                    </div>
                </div>

              
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo'); ?></label>

                    <div class="col-sm-5">
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
		<div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar_card_file'); ?></label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="aadhar_card_file" value="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('medical_certificate'); ?></label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="medical_certificate" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('birth_certificate'); ?></label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="birth_certificate" value="">
                    </div>
                </div>
		
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('add_student'); ?></button>
                    </div>
                </div>
                <br/>
                <p>Note : In Informatics, dummy data is benign information that does not contain any useful data, but serves to reserve space where real data is nominally present</p>
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

</script>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
        <?php
include("backend/includes_bottom.php");
?>
    </body>
</html>