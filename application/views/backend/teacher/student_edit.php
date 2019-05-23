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

                <div class="row">
                    <div class="col-lg-3 table-responsive edusec-pf-border no-padding edusecArLangCss" style="margin-bottom:15px">
                        <div class="col-md-12 text-center">
                            <img class="img-circle edusec-img-disp" src="<?php echo $this->crud_model->get_image_url('student', $student_info['student_id']); ?>" style="width:150px;" alt="No Image">		
                            <div class="photo-edit">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <tbody><tr>
                                    <th>Admission No</th>
                                    <td><?php echo $student_info["admission_no"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $student_info["name"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <td><?php echo $student_class["name"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Section</th>
                                    <td><?php echo $student_section["name"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Batch</th>
                                    <td><?php echo $student_batch["batch_name"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Email ID</th>
                                    <td><?php echo $student_info["email"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile No</th>
                                    <td><?php echo $student_info["phone"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <?php
                                        if ($student_info["status"] == 0) {
                                            ?>
                                            <span class="label label-danger">Inactive</span>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="label label-success">Active</span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody></table>
                    </div>

                    <div class="col-lg-9 profile-data">
                        <ul class="nav nav-tabs responsive" id="profileTab">
                            <li class="active" id="personal-tab"><a href="#personal" data-toggle="tab"><i class="fa fa-street-view"></i> Personal</a></li>
                            <li id="academic-tab"><a href="#academic" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Academic</a></li>
                            <li id="guardians-tab"><a href="#guardians" data-toggle="tab"><i class="fa fa-user"></i> Parents</a></li>
                            <li id="address-tab"><a href="#address" data-toggle="tab"><i class="fa fa-home"></i> Address</a></li>
                            <li id="documents-tab"><a href="#documents" data-toggle="tab"><i class="fa fa-file-text"></i> Documents</a></li>

                        </ul>
                        <div id="content" class="tab-content responsive">
                            <div class="tab-pane active" id="personal">


                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 class="page-header">	
                                            <i class="fa fa-info-circle"></i> Personal Details	<div class="pull-right">
                                                <a id="update-data" class="btn btn-primary btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_student_edit/<?php echo $student_info['student_id']; ?>');"><i class="fa fa-pencil-square-o"></i> Edit</a>		</div>
                                        </h2>
                                    </div><!-- /.col -->
                                </div>

                                <div class="">
                                    <table class="table-striped table table-bordered">
                                        <tr>
                                            <td>Title</td>
                                            <td><?php echo $student_info["title"]; ?></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><?php echo $student_info["name"]; ?></td>
                                            <td>Gender</td>
                                            <td><?php echo $student_info["sex"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>DOB</td>
                                            <td><?php echo $student_info["birthday"]; ?></td>
                                            <td>Religion</td>
                                            <td><?php echo $student_info["religion"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Blood Group</td>
                                            <td><?php echo $student_info["blood_group"]; ?></td>
                                            <td>Religion</td>
                                            <td><?php echo $student_info["phone"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td><?php echo $student_info["phone"]; ?></td>
                                            <td>Email</td>
                                            <td><?php echo $student_info["email"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Aadhar Card No</td>
                                            <td><?php echo $student_info["aadhar_card_no"]; ?></td>
                                            <td>Roll No</td>
                                            <td><?php echo $student_info["roll"]; ?></td>
                                        </tr>
                                    </table>

                                </div> <!---Main Row Div--->

                            </div>
                            <div class="tab-pane" id="academic">


                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <h2 class="page-header">	
                                            <i class="fa fa-info-circle"></i> Academic Details	<div class="pull-right">
                                                <a id="update-data" class="btn btn-primary btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_student_edit/<?php echo $student_info['student_id']; ?>');"><i class="fa fa-pencil-square-o"></i> Edit</a>	
                                            </div>
                                        </h2>
                                    </div><!-- /.col -->
                                </div>

                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Class</th>
                                        <td><?php echo $student_class["name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Section</th>
                                        <td><?php echo $student_section["name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Batch</th>
                                        <td><?php echo $student_batch["batch_name"]; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <?php
                                            if ($student_info["status"] == 0) {
                                                ?>
                                                <span class="label label-danger">Inactive</span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="label label-success">Active</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <div class="tab-pane" id="guardians">

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <h2 class="page-header">	
                                            <i class="fa fa-info-circle"></i> Parent Details	
                                            <?php
                                            if (!empty($student_info["parent_id"])) {
                                                ?>
                                                <div class="pull-right">
                                                    <a id="update-data" class="btn btn-primary btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_parent_edit/<?php echo $student_info['parent_id']; ?>/<?php echo $student_info['student_id']; ?>');"><i class="fa fa-pencil-square-o"></i> Edit</a>	
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </h2>
                                    </div><!-- /.col -->
                                </div>

                                <?php
                                if (empty($student_info["parent_id"])) {
                                    ?>
                                    <div>
                                        <center>Add New Parent: <a id="update-data" class="btn btn-success btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_parent_add/<?php echo $student_info['student_id']; ?>');"><i class="fa fa-pencil-square-o"></i> Add New</a>	
                                            <br><br>or<br></br>
                                            <?php echo form_open(base_url() . 'teacher/parent/update/' . $student_info["student_id"], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                                            Select Parent(Existing)
                                            <select name="parent_id">
                                                <option>Select Parent</option>
                                                <?php
                                                $res = $this->db->get("parent")->result_array();
                                                foreach ($res as $row) {
                                                    echo "<option value='" . $row["parent_id"] . "'>" . $row["father_name"] . " - " . $row["mother_name"] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="submit" class="btn btn-xs btn-success" name="submit" value="submit"/>
                                            <?php echo form_close(); ?>
                                        </center>
                                    </div>
                                    <?php
                                } else {
                                    $parent_details = $this->db->get_where("parent", array("parent_id" => $student_info["parent_id"]))->row_array();
                                    ?>

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>Father Name</td>
                                            <td><?php echo $parent_details["father_name"] ?></td>
                                            <td>Mother Name</td>
                                            <td><?php echo $parent_details["mother_name"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Father Occupation</td>
                                            <td><?php echo $parent_details["father_occupation"] ?></td>
                                            <td>Mother Occupation</td>
                                            <td><?php echo $parent_details["mother_occupation"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Father Phone</td>
                                            <td><?php echo $parent_details["father_phone"] ?></td>
                                            <td>Mother Phone</td>
                                            <td><?php echo $parent_details["mother_phone"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $parent_details["email"] ?></td>
                                            <td>Profession</td>
                                            <td><?php echo $parent_details["profession"] ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="tab-pane" id="address">

                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 class="page-header">	
                                            <i class="fa fa-info-circle"></i> Address Info	
                                            <?php
                                            if (!empty($student_info["address_id"])) {
                                                ?>
                                                <div class="pull-right">
                                                    <a id="update-data" class="btn btn-primary btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_address_edit/<?php echo $student_info['address_id']; ?>/<?php echo $student_info['student_id']; ?>');"><i class="fa fa-pencil-square-o"></i> Edit</a>	
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </h2>
                                    </div><!-- /.col -->
                                </div>

                                <?php
                                if (empty($student_info["address_id"])) {
                                    ?>
                                    <div>
                                        <center>Add New Parent: <a id="update-data" class="btn btn-success btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_address_add/<?php echo $student_info['student_id']; ?>');"><i class="fa fa-pencil-square-o"></i> Add New</a>	
                                            <br><br>or<br></br>
                                            <?php echo form_open(base_url() . 'teacher/student/updateadd/' . $student_info["student_id"], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                                            Select Parent(Existing)
                                            <select name="address_id">
                                                <option>Select Address</option>
                                                <?php
                                                $res = $this->db->get("stu_address")->result_array();
                                                foreach ($res as $row) {
                                                    echo "<option value='" . $row["stu_add_id"] . "'>" . $row["stu_add_city"] . " - " . $row["stu_add_house_no"] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="submit" class="btn btn-sm btn-success" name="submit" value="submit"/>
                                            <?php echo form_close(); ?>
                                        </center>
                                    </div>
                                    <?php
                                } else {
                                    $address_detail = $this->db->get_where("stu_address", array("stu_add_id" => $student_info["address_id"]))->row_array();
                                    ?>
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>Address</td>
                                            <td><?php echo $address_detail["stu_add"] ?></td>
                                            <td>City</td>
                                            <td><?php echo $address_detail["stu_add_city"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td><?php echo $address_detail["stu_add_state"] ?></td>
                                            <td>country</td>
                                            <td><?php echo $address_detail["stu_add_country"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pincode</td>
                                            <td><?php echo $address_detail["stu_add_pincode"] ?></td>
                                            <td>House No</td>
                                            <td><?php echo $address_detail["stu_add_house_no"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone No.</td>
                                            <td><?php echo $address_detail["stu_add_phone_no"] ?></td>

                                        </tr>
                                    </table>
                                    <?php
                                }
                                ?>


                            </div>
                            <div class="tab-pane" id="documents">
                                <!---Start Permenant Address Block--->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
                                            <i class="fa fa-files-o"></i> Upload New Document	</h4>
                                    </div><!-- /.col -->
                                </div>

                                <?php echo form_open(base_url() . 'teacher/student/documents/' . $student_info["student_id"], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select class="form-control" name="certificate_category">
                                            <option value="">Select Category</option>
                                            <option value="Aadhar Card">Aadhar Card</option>
                                            <option value="Birth Certificate">Birth Certificate</option>
                                            <option value="Medical Certificate">Medical Certificate</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Document</label>
                                        <input type="file" name="file" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>

                                        <input type="submit" class="btn btn-success" value="Upload"/>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                <br clear="all"/>
                                <!---Start Permenant Address Block--->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
                                            <i class="fa fa-files-o"></i> Uploaded Documents	</h4>
                                    </div><!-- /.col -->
                                </div>

                                <div class="table-responsive disp-doc">


                                    <table class="table table-bordered">
                                        <tbody><tr>
                                                <th class="text-center"><label for="studocs-stu_docs_category_id">Category</label></th>
                                                <th class="text-center"><label for="studocs-stu_docs_details">Document Details</label></th>
                                                <th class="text-center"><label for="studocs-stu_docs_status">Status</label></th>
                                                <th class="text-center " style="width: 34%;">Action</th>
                                            </tr>
                                            <?php
                                            if (count($documents) > 0) {
                                                foreach ($documents as $document) {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $document["stu_docs_details"] ?></td>
                                                        <td class="text-center"><a href="<?php echo base_url(); ?>uploads/document/<?php echo $document["stu_docs_path"]; ?>" target="_blank" class="btn btn-primary btn-xs">Download</a></td>
                                                        <td class="text-center">		
                                                            <span class="label label-success">Approved</span>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url("teacher/student/deldoc/" . $document["stu_docs_id"] . "/" . $student_info["student_id"]) ?>" class="label label-danger" onclick="return confirm('Do you want to delete it?')"><i class="fa fa-trash-o"></i> Delete</a>
                                                        </td>

                                                    </tr>	
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody></table>
                                </div>




                            </div>

                        </div>
                    </div>
                </div> <!---End Row Div--->

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
    function get_vehicle_route(route_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_vehicle_route/' + route_id,
            success: function(response)
            {
                jQuery('#vehicle_id').html(response);
            }
        });

    }

</script>