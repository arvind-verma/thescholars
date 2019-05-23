<html>
    <head>
        <style>
            body {
                background-color: #d7d6d3;
                font-family:'verdana';
                font-size:10px !important;
            }
            .id-card-holder {
                width: 400px;
                padding: 4px;
                margin: 0 auto;

                float:left;
            }

            .id-card {

                background-color: #fff;
                padding: 10px;
                border-radius: 10px;
                text-align: center;
                box-shadow: 0 0 1.5px 0px #b9b9b9;
            }
            .id-card img {
                margin: 0 auto;
            }
            .header img {
                width: 100px;
                margin-top: 15px;
            }
            .photo img {
                width: 80px;
                margin-top: 15px;
            }
            h2 {
                font-size: 15px;
                margin: 5px 0;
            }
            h3 {
                font-size: 12px;
                margin: 2.5px 0;
                font-weight: 300;
            }
            .qr-code img {
                width: 100px;
            }
            p {
                font-size: 10px;
                margin: 2px;
            }
            .id-card-hook {
                background-color: #000;
                width: 70px;
                margin: 0 auto;
                height: 15px;
                border-radius: 5px 5px 0 0;
            }
            .id-card-hook:after {
                content: '';
                background-color: #d7d6d3;
                width: 47px;
                height: 6px;
                display: block;
                margin: 0px auto;
                position: relative;
                top: 6px;
                border-radius: 4px;
            }
            .id-card-tag-strip {
                width: 45px;
                height: 40px;
                background-color: #0950ef;
                margin: 0 auto;
                border-radius: 5px;
                position: relative;
                top: 9px;
                z-index: 1;
                border: 1px solid #0041ad;
            }
            .id-card-tag-strip:after {
                content: '';
                display: block;
                width: 100%;
                height: 1px;
                background-color: #c1c1c1;
                position: relative;
                top: 10px;
            }
            .id-card-tag {
                width: 0;
                height: 0;
                border-left: 100px solid transparent;
                border-right: 100px solid transparent;
                border-top: 100px solid #0958db;
                margin: -10px auto -30px auto;
            }
            .id-card-tag:after {
                content: '';
                display: block;
                width: 0;
                height: 0;
                border-left: 50px solid transparent;
                border-right: 50px solid transparent;
                border-top: 100px solid #d7d6d3;
                margin: -10px auto -30px auto;
                position: relative;
                top: -130px;
                left: -50px;
            }
            table
            {
                font-size:12px;
            }
        </style>
    </head>
    <body>


        <div class="id-card-holder">
            <div class="id-card">
                <div class="header">
                    <h2 style="background:red;color:white;padding:3px;">The Scholars School</h2>
                </div>




                <table style="width: 100%">
                    <tr>
                        <td rowspan="6">
                            <div class="photo">
                                <img src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']); ?>" class="img-circle" style="border:2px solid black;height:120px;width:100px;vertical-align:top;" width="30"/>
                            </div>

                            <?php echo $student["name"] ?><br/>
                            <?php echo $student["admission_no"] ?> / <?php echo $student["roll"] ?>
                        </td>
                        <td width="40%">Class</td>
                        <td>: 
                            <?php
                            $class = $this->db->get_where("class", array("class_id" => $student["class_id"]))->row_array();
                            ?>
                            <?php echo $class["name"] ?> /
                            <?php
                            $section = $this->db->get_where("section", array("section_id" => $student["section_id"]))->row_array();
                            ?>
                            <?php echo $section["name"] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>F/M/Gdn</td>
                        <td>: <?php echo $this->crud_model->getParentName($student["parent_id"]); ?></td>
                    </tr>

                    <tr>
                        <td>D.O.B</td>
                        <td>: <?php echo $student["birthday"] ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>: <?php echo $this->crud_model->getStudentAddress($student["address_id"]); ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>: <?php echo $student["phone"] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <img alt="Barcode" src="http://davidscotttufts.com/code/barcode.php?codetype=Code39&size=30&text=<?php echo $student["admission_no"];?>&print=true" />
                        </td>
                    </tr>
                </table>

                <p style="background:red;color:white;text-align: center;">
                    Ambala-Nanaingarh Road Ambala City,<br/>
                    Contact - 84347983457,3495345349, 74583459874<br/>
                    E-mail : demo@gmail.com
                </p>
            </div>
        </div>
    </body>
</html>