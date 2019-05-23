<?php
$payment = $this->db->get_where('payment', array('payment_id' => $param1))->row_array();
$student = $this->db->get_where("student", array("student_id" => $payment["student_id"]))->row_array();
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url(); ?><?php echo base_url(); ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-core.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-theme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-forms.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/wysihtml5/bootstrap-wysihtml5.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/black.css">

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>        
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>        
        <script src="<?php echo base_url(); ?>assets/js/gsap/main-gsap.js"></script>        
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>        
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/joinable.js"></script>        
        <script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/rickshaw/vendor/d3.v3.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/neon-custom.js"></script>               	
        <script src="<?php echo base_url(); ?>assets/js/neon-api.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>        
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>        
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables/TableTools.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables/lodash.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.inputmask.bundle.min.js"></script>
        <style>
            body
            {
                color:green;
            }
            p {
                margin: 0 0 1.5px;
                font-size: 12px;
            }
            td{
                padding:5px !important;
            }
            hr{
                margin-top:5px !important;
                margin-bottom:5px !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div style='float:left;margin-right:20px;'>
                <table class="table table-bordered" style='width:280px;'>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p style="float:left;">Axis Bank</p><p style="float:right">SCHOOL COPY</p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                    <center><img src='<?php echo base_url(); ?>theschoolar.jpg' width="150px"></center>
                    <p align="center">Sector - 1, Ambala City - 134003</p>
                    <hr/>
                    <p>Account Number : 918010027874083</p>
                    <p>Pan Number : AAATT8577F</p>
                    <p>Name of the Bank : Axis Bank</p>
                    <p>Branch : Garnala, Ambala</p>
                    </td>

                    </tr>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p align="center" >First Consolidated Quarterly Fee</p></td>
                    </tr>
                    <tr>
                        <td>Receipt No : ______</td>
                        <td>Roll No : <?php echo $student["roll"]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>Student's Name - <?php echo $student["name"]; ?></p></td>
                    </tr>
                    <tr>
                        <?php
                        $parent = $this->db->get_where("parent", array("parent_id" => $student["parent_id"]))->row_array();
                        ?>
                        <td colspan="2"><p>Father's Name - <?php echo $parent["father_name"]; ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Date _________ 

                                <?php
                                $row_class = $this->db->get_where("class", array("class_id" => $student["class_id"]))->row_array();
                                $row_section = $this->db->get_where("section", array("section_id" => $student["section_id"]))->row_array();
                                ?>
                                Class:  <?php echo $row_class["name"] ?>     &nbsp;&nbsp;
                                Section : <?php echo $row_section["name"] ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Contact No - <?php echo $student["phone"]; ?></p>
                    <center><b>Mark the Mode of Payment</b></center>
                    In Cash <input type='checkbox'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By Cheque / D.D <input type='checkbox'>
                    <br/>
                    <p><b>If Cheque/D.D Please Give:</b></p>
                    <p>Cheque/D.D Number ___________________</p>
                    <p>Drawn on ___________________</p>
                    <p>Amount in words _______________________</p>
                    <p>_______________________________________</p>

                    </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>Total   : Rs.  <?php echo $payment["amount"]; ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style='float:left;'>____________<br/>Depositor's Sign</p>
                            <p style='float:right'>____________________<br/>Bank Official's(Seal & Sign)</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p align='center'>IFSC Code :  UTIB0000888</p></td>
                    </tr>
                </table>
            </div>
            <div style='float:left;margin-right:20px;'>
                <table class="table table-bordered" style='width:280px;'>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p style="float:left;">Axis Bank</p><p style="float:right">SCHOOL COPY</p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                    <center><img src='<?php echo base_url(); ?>theschoolar.jpg' width="150px"></center>
                    <p align="center">Sector - 1, Ambala City - 134003</p>
                    <hr/>
                    <p>Account Number : 918010027874083</p>
                    <p>Pan Number : AAATT8577F</p>
                    <p>Name of the Bank : Axis Bank</p>
                    <p>Branch : Garnala, Ambala</p>
                    </td>

                    </tr>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p align="center" >First Consolidated Quarterly Fee</p></td>
                    </tr>
                    <tr>
                        <td>Receipt No : ______</td>
                        <td>Roll No : <?php echo $student["roll"]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>Student's Name - <?php echo $student["name"]; ?></p></td>
                    </tr>
                    <tr>
                        <?php
                        $parent = $this->db->get_where("parent", array("parent_id" => $student["parent_id"]))->row_array();
                        ?>
                        <td colspan="2"><p>Father's Name - <?php echo $parent["father_name"]; ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Date _________ 

                                <?php
                                $row_class = $this->db->get_where("class", array("class_id" => $student["class_id"]))->row_array();
                                $row_section = $this->db->get_where("section", array("section_id" => $student["section_id"]))->row_array();
                                ?>
                                Class:  <?php echo $row_class["name"] ?>     &nbsp;&nbsp;
                                Section : <?php echo $row_section["name"] ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Contact No - <?php echo $student["phone"]; ?></p>
                    <center><b>Mark the Mode of Payment</b></center>
                    In Cash <input type='checkbox'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By Cheque / D.D <input type='checkbox'>
                    <br/>
                    <p><b>If Cheque/D.D Please Give:</b></p>
                    <p>Cheque/D.D Number ___________________</p>
                    <p>Drawn on ___________________</p>
                    <p>Amount in words _______________________</p>
                    <p>_______________________________________</p>

                    </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>Total   : Rs.  <?php echo $payment["amount"]; ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style='float:left;'>____________<br/>Depositor's Sign</p>
                            <p style='float:right'>____________________<br/>Bank Official's(Seal & Sign)</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p align='center'>IFSC Code :  UTIB0000888</p></td>
                    </tr>
                </table>
            </div>
            <div style='float:left;margin-right:20px;'>
                <table class="table table-bordered" style='width:280px;'>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p style="float:left;">Axis Bank</p><p style="float:right">SCHOOL COPY</p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                    <center><img src='<?php echo base_url(); ?>theschoolar.jpg' width="150px"></center>
                    <p align="center">Sector - 1, Ambala City - 134003</p>
                    <hr/>
                    <p>Account Number : 918010027874083</p>
                    <p>Pan Number : AAATT8577F</p>
                    <p>Name of the Bank : Axis Bank</p>
                    <p>Branch : Garnala, Ambala</p>
                    </td>

                    </tr>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p align="center" >First Consolidated Quarterly Fee</p></td>
                    </tr>
                    <tr>
                        <td>Receipt No : ______</td>
                        <td>Roll No : <?php echo $student["roll"]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>Student's Name - <?php echo $student["name"]; ?></p></td>
                    </tr>
                    <tr>
                        <?php
                        $parent = $this->db->get_where("parent", array("parent_id" => $student["parent_id"]))->row_array();
                        ?>
                        <td colspan="2"><p>Father's Name - <?php echo $parent["father_name"]; ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Date _________ 

                                <?php
                                $row_class = $this->db->get_where("class", array("class_id" => $student["class_id"]))->row_array();
                                $row_section = $this->db->get_where("section", array("section_id" => $student["section_id"]))->row_array();
                                ?>
                                Class:  <?php echo $row_class["name"] ?>     &nbsp;&nbsp;
                                Section : <?php echo $row_section["name"] ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Contact No - <?php echo $student["phone"]; ?></p>
                    <center><b>Mark the Mode of Payment</b></center>
                    In Cash <input type='checkbox'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By Cheque / D.D <input type='checkbox'>
                    <br/>
                    <p><b>If Cheque/D.D Please Give:</b></p>
                    <p>Cheque/D.D Number ___________________</p>
                    <p>Drawn on ___________________</p>
                    <p>Amount in words _______________________</p>
                    <p>_______________________________________</p>

                    </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>Total   : Rs.  <?php echo $payment["amount"]; ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style='float:left;'>____________<br/>Depositor's Sign</p>
                            <p style='float:right'>____________________<br/>Bank Official's(Seal & Sign)</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background: green;color:white;height:10px;" colspan="2"><p align='center'>IFSC Code :  UTIB0000888</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>