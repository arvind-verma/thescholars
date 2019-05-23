<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <?php echo img(['src' => 'uploads/logo.png', 'style' => 'max-height:60px']); ?>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_add' || $page_name == 'admission_enquiry' ||
                $page_name == 'student_bulk_add' ||
                $page_name == 'student_information' ||
                $page_name == 'student_marksheet' || $page_name == 'promote_class')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('student'); ?></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'admission_enquiry') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/admission_enquiry">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admission_enquiry'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/student_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admission_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'student_bulk_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/student_bulk_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admission_bulk_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>admin/student_information/<?php echo $row['class_id']; ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- STUDENT MARKSHEET -->
                <li class="<?php if ($page_name == 'student_marksheet') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_marksheet'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>admin/student_marksheet/<?php echo $row['class_id']; ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'promote_class') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/promote_class">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('promote_class'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/teacher">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>

        <!-- PARENTS -->
        <li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/parent">
                <i class="entypo-user"></i>
                <span><?php echo get_phrase('parents'); ?></span>
            </a>
        </li>

        <!-- CLASS -->
        <li class="<?php
        if ($page_name == 'class' ||
                $page_name == 'section')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('class'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/classes">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_classes'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/section">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_sections'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'batch') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/batch">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_batches'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>admin/subject/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/class_routine">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
        </li>

        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/manage_attendance/<?php echo date("d/m/Y"); ?>">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('daily_attendance'); ?></span>
            </a>

        </li>

        <!-- EXAMS -->
        <li class="<?php
        if ($page_name == 'exam' ||
                $page_name == 'grade' ||
                $page_name == 'marks' ||
                $page_name == 'exam_marks_sms')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'exam') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/exam">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/grade">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_grades'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/marks">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'exam_marks_sms') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/exam_marks_sms">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('send_marks_by_sms'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

       

        <!-- ACCOUNTING -->
        <li class="<?php
        if ($page_name == 'income' || $page_name == 'invoice' || $page_name == 'take_payment' ||  
                $page_name == 'expense' || $page_name == 'fee_category' || $page_name == 'fee_structure' || 
                $page_name == 'expense_category')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('fee'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'fee_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/fee_category">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('fee_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'fee_structure') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/fee_structure">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('fee_structure'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/invoice">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('payment'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/income">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('income'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/expense">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/expense_category">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense_category'); ?></span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="<?php
        if ($page_name == 'library' ||
                $page_name == 'return_book' ||
                $page_name == 'issue_book')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/book">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('books'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'issue_book') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/issue_book">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('issue_book'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'return_book') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/return_book">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('return_book'); ?></span>
                    </a>
                </li>
            </ul>
        </li>



        <li class="<?php
        if ($page_name == 'transport' ||
                $page_name == 'vehicle_detail' ||
                $page_name == 'driver_detail')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('transport'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/transport">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('transport'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'driver_detail') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/driver_detail">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('driver_detail'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'vehicle_detail') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/vehicle_detail">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('vehicle_detail'); ?></span>
                    </a>
                </li>

            </ul>
        </li>

        <!-- TRANSPORT -->




        <!-- holidays -->
        <li class="<?php if ($page_name == 'holiday') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/holidays">
                <i class="entypo-location"></i>
                <span><?php echo get_phrase('holidays'); ?></span>
            </a>
        </li>

        <!-- DORMITORY -->


        <li class="<?php
        if ($page_name == 'hostel' ||
                $page_name == 'guardian_detail' ||
                $page_name == 'hostel_complaint')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-home"></i>
                <span><?php echo get_phrase('hostel'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'guardian_detail') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/guardian_detail">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('guardian_detail'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/dormitory">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('hostel'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'hoste_complaint') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/hostel_complaint">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('hostel_complaint'); ?></span>
                    </a>
                </li>


            </ul>
        </li>

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'security') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/security">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('security'); ?></span>
            </a>
        </li>

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
                $page_name == 'sms_settings')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/system_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/sms_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/manage_language">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>