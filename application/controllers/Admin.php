<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default function, redirects to login page if no admin logged in yet** */

    public function index() {
        redirect(site_url('admin/dashboard'), 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /*     * **MANAGE STUDENTS CLASSWISE**** */

    function student_add($param1 = '') {
        $page_data['page_name'] = 'student_add';
        $page_data['param1'] = $param1;
        $page_data["total_students"] = $select_students = $this->db->get("student")->num_rows() + 1;
        $page_data['page_title'] = get_phrase('add_student');
        $this->load->view('backend/index', $page_data);
    }

    function student_edit($param1 = '') {
        $page_data['page_name'] = 'student_edit';
        $page_data['page_title'] = get_phrase('edit_student');
        $page_data['student_info'] = $this->db->get_where("student", array("student_id" => $param1))->row_array();
        $page_data["student_class"] = $this->db->get_where("class", array("class_id" => $page_data['student_info']["class_id"]))->row_array();
        $page_data["student_section"] = $this->db->get_where("section", array("section_id" => $page_data['student_info']["section_id"]))->row_array();
        $page_data["student_batch"] = $this->db->get_where("batch", array("batch_id" => $page_data['student_info']["batch_id"]))->row_array();
        $page_data["documents"] = $this->db->get_where("stu_docs", array("student_id" => $param1))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function student_bulk_add($param1 = '') {

        if ($param1 == 'import_excel') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_import.xlsx');
            // Importing excel sheet for bulk student uploads

            include 'Simplexlsx.class.php';

            $xlsx = new SimpleXLSX('uploads/student_import.xlsx');

            list($num_cols, $num_rows) = $xlsx->dimension();
            $f = 0;
            foreach ($xlsx->rows() as $r) {
                // Ignore the inital name row of excel file
                if ($f == 0) {
                    $f++;
                    continue;
                } else {
                    for ($i = 0; $i < $num_cols; $i++) {
                        if ($i == 0)
                            $data['name'] = $r[$i];
                        else if ($i == 1)
                            $data['birthday'] = $r[$i];
                        else if ($i == 2)
                            $data['sex'] = $r[$i];
                        else if ($i == 3)
                            $data['address'] = $r[$i];
                        else if ($i == 4)
                            $data['phone'] = $r[$i];
                        else if ($i == 5)
                            $data['email'] = $r[$i];
                        else if ($i == 6)
                            $data['password'] = $r[$i];
                        else if ($i == 7)
                            $data['roll'] = $r[$i];
                        else if ($i == 8)
                            $data['admission_no'] = $r[$i];
                    }
                    $data['class_id'] = $this->input->post('class_id');
                    $data['section_id'] = $this->input->post('section_id');
                    $data['batch_id'] = $this->input->post('batch_id');
                    $data['status'] = 1;
                    $data['created'] = date("Y-m-d");
                    $this->db->insert('student', $data);
                }
                //print_r($data);
            }
            redirect(base_url() . 'admin/student_information/' . $this->input->post('class_id'), 'refresh');
        }
        $page_data['page_name'] = 'student_bulk_add';
        $page_data['page_title'] = get_phrase('add_bulk_student');
        $this->load->view('backend/index', $page_data);
    }

    function student_information($class_id = '', $section_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_name'] = 'student_information';
        $page_data['page_title'] = get_phrase('student_information') . " - " . get_phrase('class') . " : " .
                $this->crud_model->get_class_name($class_id);
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet($class_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_name'] = 'student_marksheet';
        $page_data['page_title'] = get_phrase('student_marksheet') . " - " . get_phrase('class') . " : " .
                $this->crud_model->get_class_name($class_id);
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    /*     * **MANAGE SUBJECTS**** */

    function admission_enquiry($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['father_name'] = $this->input->post('father_name');
            $data['dob'] = $this->input->post('dob');
            $data['gender'] = $this->input->post('gender');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['class_id'] = $this->input->post('class_id');
            $data['query'] = $this->input->post('query');
            $data['created'] = date("Y-m-d");

            $this->db->insert('stu_enquiry', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'admin/admission_enquiry/' . $data['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['father_name'] = $this->input->post('father_name');
            $data['dob'] = $this->input->post('dob');
            $data['gender'] = $this->input->post('gender');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['class_id'] = $this->input->post('class_id');
            $data['query'] = $this->input->post('query');

            if (isset($_POST["status"])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }

            $this->db->where('stu_enquiry_id', $param2);
            $this->db->update('stu_enquiry', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'admin/admission_enquiry/' . $data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                        'subject_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('stu_enquiry_id', $param2);
            $this->db->delete('stu_enquiry');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'admin/admission_enquiry/' . $param3, 'refresh');
        }
        $page_data['class_id'] = $param1;
        $page_data['enquires'] = $this->db->get('stu_enquiry')->result_array();
        $page_data['page_name'] = 'admission_enquiry';
        $page_data['page_title'] = get_phrase('admission_enquiry');
        $this->load->view('backend/index', $page_data);
    }

    function student($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {

            $data['admission_no'] = $this->input->post('admission_no');
            $data['password'] = $this->input->post('admission_no');
            $data['aadhar_card_no'] = $this->input->post('aadhar_card_no');
            $data['title'] = $this->input->post('title');
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['religion'] = $this->input->post('religion');
            $data['class_id'] = $this->input->post('class_id');
            $data['batch_id'] = $this->input->post('batch_id');
            $data['roll'] = $this->input->post('roll');
            $data['status'] = 1;

            if ($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }

            if (!empty($_FILES['userfile']['name']))
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');

            if ($this->input->post('dormitory_id'))
                $data['dormitory_id'] = $this->input->post('dormitory_id');

            if ($this->input->post('transport_id'))
                $data['transport_id'] = $this->input->post('transport_id');

            if ($this->input->post('vehicle_id'))
                $data['vehicle_id'] = $this->input->post('vehicle_id');

            $data['created'] = date("Y-m-d");
            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();

            if ($this->input->post("admission_by_enquiry") != "") {
                $this->db->delete("stu_enquiry", array("stu_enquiry_id" => $this->input->post("admission_by_enquiry")));
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'admin/student_add/' . $data['class_id'], 'refresh');
        }
        if ($param1 == 'createadd') {
            $address = array();
            $address["stu_add"] = $this->input->post("student_address");
            $address["stu_add_city"] = $this->input->post("student_city");
            $address["stu_add_state"] = $this->input->post("student_state");
            $address["stu_add_country"] = $this->input->post("student_country");
            $address["stu_add_pincode"] = $this->input->post("student_pincode");
            $address["stu_add_house_no"] = $this->input->post("student_house_no");
            $address["stu_add_phone_no"] = $this->input->post("student_phone");
            $this->db->insert("stu_address", $address);
            $address_id = $this->db->insert_id();

            $this->db->update("student", array("address_id" => $address_id), array("student_id" => $param2));
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'admin/student_edit/' . $param2, 'refresh');
        }
        if ($param1 == 'editadd') {

            $address = array();
            $address["stu_add"] = $this->input->post("student_address");
            $address["stu_add_city"] = $this->input->post("student_city");
            $address["stu_add_state"] = $this->input->post("student_state");
            $address["stu_add_country"] = $this->input->post("student_country");
            $address["stu_add_pincode"] = $this->input->post("student_pincode");
            $address["stu_add_house_no"] = $this->input->post("student_house_no");
            $address["stu_add_phone_no"] = $this->input->post("student_phone");
            $this->db->update("stu_address", $address, array("stu_add_id" => $param2));

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'admin/student_edit/' . $param3, 'refresh');
        }
        if ($param1 == 'updateadd') {
            $this->db->update("student", array("address_id" => $this->input->post("address_id")), array("student_id" => $param2));

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            //   $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'admin/student_edit/' . $param2, 'refresh');
        }
        if ($param1 == "deldoc") {
            $this->db->delete("stu_docs", array("stu_docs_id" => $param2));
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'admin/student_edit/' . $param3, 'refresh');
        }
        if ($param1 == 'documents') {

            if (!empty($_FILES["file"]["name"])) {

                $random = date("YmdHis") . rand(11, 99);
                $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                $file_path = $random . "." . $extension;
                $playlist = array();
                if ($extension == "doc" || $extension == "pdf" || $extension == "docx" || $extension == "png" || $extension == "jpg") {
                    move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/document/" . $file_path);
                }
                $documents = array();
                $documents["stu_docs_details"] = $this->input->post("certificate_category");
                $documents["stu_docs_path"] = $file_path;
                $documents["stu_docs_status"] = 1;
                $documents["student_id"] = $param2;
                $documents["created"] = date("Y-m-d");
                $this->db->insert("stu_docs", $documents);
            }
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'admin/student_edit/' . $param2, 'refresh');
        }
        if ($param2 == 'do_update') {
            $data['admission_no'] = $this->input->post('admission_no');
            $data['password'] = $this->input->post('admission_no');
            $data['aadhar_card_no'] = $this->input->post('aadhar_card_no');
            $data['title'] = $this->input->post('title');
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['religion'] = $this->input->post('religion');
            $data['class_id'] = $this->input->post('class_id');
            $data['batch_id'] = $this->input->post('batch_id');
            $data['roll'] = $this->input->post('roll');
            if ($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            if ($this->input->post('dormitory_id'))
                $data['dormitory_id'] = $this->input->post('dormitory_id');

            if ($this->input->post('transport_id'))
                $data['transport_id'] = $this->input->post('transport_id');

            if ($this->input->post('vehicle_id'))
                $data['vehicle_id'] = $this->input->post('vehicle_id');

            $this->db->where('student_id', $param3);
            $this->db->update('student', $data);

            if (!empty($_FILES['userfile']['name']))
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');


            $this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'admin/student_information/' . $param1, 'refresh');
        }

        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'admin/student_information/' . $param1, 'refresh');
        }
        if ($param1 == 'identity_card') {
            $page_data['page_name'] = 'student_information';

            $page_data["student"] = $this->db->get_where("student", array("student_id" => $param2))->row_array();
            $this->load->view('backend/admin/identity_card', $page_data);
        }
    }

    /* manage promote class */

    function promote_class($param1 = '', $param2 = '', $param3 = '') {
        $page_data['teachers'] = $this->db->get('teacher')->result_array();
        $page_data['page_name'] = 'promote_class';
        $page_data['page_title'] = get_phrase('promote_class');
        $this->load->view('backend/index', $page_data);
    }

    function promote_class_action() {
        foreach ($_POST["student_ids"] as $student_id) {
            $student = array();
            $student["class_id"] = $this->input->post("new_class_id");
            $student["section_id"] = $this->input->post("new_section_id");
            $student["batch_id"] = $this->input->post("new_batch_id");
            $this->db->update("student", $student, array("student_id" => $student_id));
        }
        $this->session->set_flashdata('flash_message', get_phrase('class_promoted'));
        redirect(base_url() . 'admin/promote_class/', 'refresh');
    }

    function getStudentsByBatch() {
        $result = $this->db->query("select * from student where class_id='" . $_GET["class_id"] . "' and batch_id='" . $_GET["batch_id"] . "' and section_id='" . $_GET["section_id"] . "'")->result_array();
        foreach ($result as $row_student) {
            $records[] = $row_student;
        }
        echo json_encode($records);
    }

    /*     * **MANAGE PARENTS CLASSWISE**** */

    function parent($param1 = '', $param2 = '', $param3 = '')
    {
    if($this->  session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['father_name'] = $this->input->post('father_name');
        $data['father_occupation'] = $this->input->post('father_occupation');
        $data['father_aadhar_card'] = $this->input->post('father_aadhar_card');
        $data['father_phone'] = $this->input->post('father_phone');
        $data['mother_name'] = $this->input->post('mother_name');
        $data['mother_occupation'] = $this->input->post('mother_occupation');
        $data['mother_aadhar_card'] = $this->input->post('mother_aadhar_card');
        $data['mother_phone'] = $this->input->post('mother_phone');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');

        $data['profession'] = $this->input->post('profession');
        $this->db->insert('parent', $data);
        $parent_id = $this->db->insert_id();

        $this->db->update("student", array("parent_id" => $parent_id), array("student_id" => $param2));

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        //   $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'admin/student_edit/' . $param2, 'refresh');
    }
    if ($param1 == 'edit') {
        $data['father_name'] = $this->input->post('father_name');
        $data['father_occupation'] = $this->input->post('father_occupation');
        $data['father_aadhar_card'] = $this->input->post('father_aadhar_card');
        $data['father_phone'] = $this->input->post('father_phone');
        $data['mother_name'] = $this->input->post('mother_name');
        $data['mother_occupation'] = $this->input->post('mother_occupation');
        $data['mother_aadhar_card'] = $this->input->post('mother_aadhar_card');
        $data['mother_phone'] = $this->input->post('mother_phone');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');

        $data['profession'] = $this->input->post('profession');
        $this->db->where('parent_id', $param2);
        $this->db->update('parent', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/student_edit/' . $param3, 'refresh');
    }
    if ($param1 == 'update') {
        $this->db->update("student", array("parent_id" => $this->input->post("parent_id")), array("student_id" => $param2));

        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        //   $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'admin/student_edit/' . $param3, 'refresh');
    }
    if ($param1 == 'delete') {
        $this->db->where('parent_id', $param2);
        $this->db->delete('parent');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/parent/', 'refresh');
    }
    $page_data['page_title'] = get_phrase('all_parents');
    $page_data['page_name'] = 'parent';
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE TEACHERS**** */

function teacher($param1 = '', $param2 = '', $param3 = '') {
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $this->db->insert('teacher', $data);
        $teacher_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'admin/teacher/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');

        $this->db->where('teacher_id', $param2);
        $this->db->update('teacher', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/teacher/', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_teacher_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('teacher', array(
                    'teacher_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/teacher/', 'refresh');
    }
    $page_data['teachers'] = $this->db->get('teacher')->result_array();
    $page_data['page_name'] = 'teacher';
    $page_data['page_title'] = get_phrase('manage_teacher');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE SUBJECTS**** */

function subject($param1 = '', $param2 = '', $param3 = '') {
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->insert('subject', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/subject/' . $data['class_id'], 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');

        $this->db->where('subject_id', $param2);
        $this->db->update('subject', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/subject/' . $data['class_id'], 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('subject', array(
                    'subject_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('subject_id', $param2);
        $this->db->delete('subject');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/subject/' . $param3, 'refresh');
    }
    $page_data['class_id'] = $param1;
    $page_data['subjects'] = $this->db->get_where('subject', array('class_id' => $param1))->result_array();
    $page_data['page_name'] = 'subject';
    $page_data['page_title'] = get_phrase('manage_subject');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE CLASSES**** */

function classes($param1 = '', $param2 = '') {
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['name_numeric'] = $this->input->post('name_numeric');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->insert('class', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/classes/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['name_numeric'] = $this->input->post('name_numeric');
        $data['teacher_id'] = $this->input->post('teacher_id');

        $this->db->where('class_id', $param2);
        $this->db->update('class', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/classes/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class', array(
                    'class_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('class_id', $param2);
        $this->db->delete('class');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/classes/', 'refresh');
    }
    $page_data['classes'] = $this->db->get('class')->result_array();
    $page_data['page_name'] = 'class';
    $page_data['page_title'] = get_phrase('manage_class');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE BATCHES**** */

function batch($param1 = '', $param2 = '') {
    if ($param1 == 'create') {
        $data['batch_name'] = $this->input->post('name');
        $data['current_year'] = $this->input->post('current_year');
        $this->db->insert('batch', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/batch/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['batch_name'] = $this->input->post('name');
        $data['current_year'] = $this->input->post('current_year');

        $this->db->where('batch_id', $param2);
        $this->db->update('batch', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/batch/', 'refresh');
    } else if ($param1 == 'edit') {
        $this->db->where('current_batch', 1);
        $this->db->update('batch', array("current_batch" => 0));

        $this->db->where('batch_id', $param2);
        $this->db->update('batch', array("current_batch" => 1));
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/batch/', 'refresh');
    }
    if ($param1 == 'delete') {
        $this->db->where('batch_id', $param2);
        $this->db->delete('batch');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/batch/', 'refresh');
    }
    $page_data['batches'] = $this->db->get('batch')->result_array();
    $page_data['page_name'] = 'batch';
    $page_data['page_title'] = get_phrase('manage_batches');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE SECTIONS**** */

function section($class_id = '') {
    // detect the first class
    if ($class_id == '')
        $class_id = $this->db->get('class')->first_row()->class_id;

    $page_data['page_name'] = 'section';
    $page_data['page_title'] = get_phrase('manage_sections');
    $page_data['class_id'] = $class_id;
    $this->load->view('backend/index', $page_data);
}

function sections($param1 = '', $param2 = '') {
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['nick_name'] = $this->input->post('nick_name');
        $data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->insert('section', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/section/' . $data['class_id'], 'refresh');
    }

    if ($param1 == 'edit') {
        $data['name'] = $this->input->post('name');
        $data['nick_name'] = $this->input->post('nick_name');
        $data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->where('section_id', $param2);
        $this->db->update('section', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/section/' . $data['class_id'], 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('section_id', $param2);
        $this->db->delete('section');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/section', 'refresh');
    }
}

function get_vehicle_route($route_id) {
    $vehicles = $this->db->get_where('vehicle_detail', array(
                'transport_id' => $route_id
            ))->result_array();
    foreach ($vehicles as $row) {
        echo '<option value="' . $row['vehicle_id'] . '">' . $row['vehicle_name'] . '</option>';
    }
}

function get_class_section($class_id) {
    $sections = $this->db->get_where('section', array(
                'class_id' => $class_id
            ))->result_array();
    foreach ($sections as $row) {
        echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
    }
}

function get_section_subjects($class_id) {
    $sections = $this->db->get_where('subject', array(
                'class_id' => $class_id
            ))->result_array();
    foreach ($sections as $row) {
        echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
    }
}

function get_class_subject($class_id) {
    $subjects = $this->db->get_where('subject', array(
                'class_id' => $class_id
            ))->result_array();
    foreach ($subjects as $row) {
        echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
    }
}

/* * **MANAGE Holidays**** */

function holidays($param1 = '', $param2 = '') {
    if ($param1 == 'create') {
        $data['holiday_title'] = $this->input->post('holiday_title');
        $data['date'] = $this->input->post('date');
        $this->db->insert('holidays', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/holidays/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['holiday_title'] = $this->input->post('holiday_title');
        $this->db->where('holiday_id', $param2);
        $this->db->update('holidays', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/holidays/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class', array(
                    'class_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('holiday_id', $param2);
        $this->db->delete('holidays');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/holidays/', 'refresh');
    }
    $page_data['holidays'] = $this->db->get('holidays')->result_array();
    $page_data['page_name'] = 'holiday';
    $page_data['page_title'] = get_phrase('manage_holiday');
    $this->load->view('backend/index', $page_data);
}

/* for security */

function security($param1 = '', $param2 = '') {
    if ($param1 == 'create') {
        $data['purpose'] = $this->input->post('purpose');
        $data['visitor_name'] = $this->input->post('visitor_name');
        $data['contact_no'] = $this->input->post('contact_no');
        $data['time'] = $this->input->post('time');
        $data['date'] = $this->input->post('date');
        $this->db->insert('security', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/security/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['purpose'] = $this->input->post('purpose');
        $data['visitor_name'] = $this->input->post('visitor_name');
        $data['contact_no'] = $this->input->post('contact_no');
        $data['time'] = $this->input->post('time');
        $data['date'] = $this->input->post('date');
        $this->db->where('security_id', $param2);
        $this->db->update('security', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/security/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('security', array(
                    'security_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('security_id', $param2);
        $this->db->delete('security');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/security/', 'refresh');
    }
    $page_data['securitys'] = $this->db->get('security')->result_array();
    $page_data['page_name'] = 'security';
    $page_data['page_title'] = get_phrase('manage_security');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE Tasks**** */

function tasks($param1 = '', $param2 = '') {
    if ($param1 == 'create') {
        $data['task_name'] = $this->input->post('task_name');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['teacher_id'] = $this->session->userdata("teacher_id");
        $data['date'] = $this->input->post('date');
        $this->db->insert('tasks', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/tasks/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['task_name'] = $this->input->post('task_name');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['date'] = $this->input->post('date');
        $this->db->where('task_id', $param2);
        $this->db->update('tasks', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/tasks/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class', array(
                    'class_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('task_id', $param2);
        $this->db->delete('tasks');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/tasks/', 'refresh');
    }
    $page_data['tasks'] = $this->db->get_where('tasks', array("teacher_id" => $this->session->userdata("teacher_id")))->result_array();
    $page_data['page_name'] = 'tasks';
    $page_data['page_title'] = get_phrase('manage_tasks');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE EXAMS**** */

function exam($param1 = '', $param2 = '', $param3 = '') {
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['date'] = $this->input->post('date');
        $data['comment'] = $this->input->post('comment');
        $this->db->insert('exam', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/exam/', 'refresh');
    }
    if ($param1 == 'edit' && $param2 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['date'] = $this->input->post('date');
        $data['comment'] = $this->input->post('comment');

        $this->db->where('exam_id', $param3);
        $this->db->update('exam', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/exam/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('exam', array(
                    'exam_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('exam_id', $param2);
        $this->db->delete('exam');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/exam/', 'refresh');
    }
    $page_data['exams'] = $this->db->get('exam')->result_array();
    $page_data['page_name'] = 'exam';
    $page_data['page_title'] = get_phrase('manage_exam');
    $this->load->view('backend/index', $page_data);
}

/* * **** SEND EXAM MARKS VIA SMS ******* */

function exam_marks_sms($param1 = '', $param2 = '') {

    if ($param1 == 'send_sms') {

        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $receiver = $this->input->post('receiver');

        // get all the students of the selected class
        $students = $this->db->get_where('student', array(
                    'class_id' => $class_id
                ))->result_array();
        // get the marks of the student for selected exam
        foreach ($students as $row) {
            if ($receiver == 'student')
                $receiver_phone = $row['phone'];
            if ($receiver == 'parent' && $row['parent_id'] != '')
                $receiver_phone = $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->phone;


            $this->db->where('exam_id', $exam_id);
            $this->db->where('student_id', $row['student_id']);
            $marks = $this->db->get('mark')->result_array();
            $message = '';
            foreach ($marks as $row2) {
                $subject = $this->db->get_where('subject', array('subject_id' => $row2['subject_id']))->row()->name;
                $mark_obtained = $row2['mark_obtained'];
                $message .= $row2['student_id'] . $subject . ' : ' . $mark_obtained . ' , ';
            }
            // send sms
            $this->sms_model->send_sms($message, $receiver_phone);
        }
        $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
        redirect(base_url() . 'admin/exam_marks_sms', 'refresh');
    }

    $page_data['page_name'] = 'exam_marks_sms';
    $page_data['page_title'] = get_phrase('send_marks_by_sms');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE EXAM MARKS**** */

function marks($exam_id = '', $class_id = '', $subject_id = '') {

    if ($this->input->post('operation') == 'selection') {
        $page_data['exam_id'] = $this->input->post('exam_id');
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['subject_id'] = $this->input->post('subject_id');

        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
            redirect(base_url() . 'admin/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
            redirect(base_url() . 'admin/marks/', 'refresh');
        }
    }
    if ($this->input->post('operation') == 'update') {
        $data['mark_obtained'] = $this->input->post('mark_obtained');
        $data['comment'] = $this->input->post('comment');

        $this->db->where('mark_id', $this->input->post('mark_id'));
        $this->db->update('mark', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
    }
    $page_data['exam_id'] = $exam_id;
    $page_data['class_id'] = $class_id;
    $page_data['subject_id'] = $subject_id;

    $page_data['page_info'] = 'Exam marks';

    $page_data['page_name'] = 'marks';
    $page_data['page_title'] = get_phrase('manage_exam_marks');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE GRADES**** */

function grade($param1 = '', $param2 = '') {
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['grade_point'] = $this->input->post('grade_point');
        $data['mark_from'] = $this->input->post('mark_from');
        $data['mark_upto'] = $this->input->post('mark_upto');
        $data['comment'] = $this->input->post('comment');
        $this->db->insert('grade', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/grade/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['grade_point'] = $this->input->post('grade_point');
        $data['mark_from'] = $this->input->post('mark_from');
        $data['mark_upto'] = $this->input->post('mark_upto');
        $data['comment'] = $this->input->post('comment');

        $this->db->where('grade_id', $param2);
        $this->db->update('grade', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/grade/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('grade', array(
                    'grade_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('grade_id', $param2);
        $this->db->delete('grade');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/grade/', 'refresh');
    }
    $page_data['grades'] = $this->db->get('grade')->result_array();
    $page_data['page_name'] = 'grade';
    $page_data['page_title'] = get_phrase('manage_grade');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGING CLASS ROUTINE***************** */

function class_routine($param1 = '', $param2 = '', $param3 = '') {
    if ($param1 == 'create') {
        $data['class_id'] = $this->input->post('class_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
        $data['time_end'] = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
        $data['day'] = $this->input->post('day');
        $this->db->insert('class_routine', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/class_routine/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['class_id'] = $this->input->post('class_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
        $data['time_end'] = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
        $data['day'] = $this->input->post('day');

        $this->db->where('class_routine_id', $param2);
        $this->db->update('class_routine', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/class_routine/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                    'class_routine_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('class_routine_id', $param2);
        $this->db->delete('class_routine');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/class_routine/', 'refresh');
    }
    $page_data['page_name'] = 'class_routine';
    $page_data['page_title'] = get_phrase('manage_class_routine');
    $this->load->view('backend/index', $page_data);
}

/* * **** DAILY ATTENDANCE **************** */

function manage_attendance($date = '', $month = '', $year = '', $class_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

    if ($_POST) {
        // Loop all the students of $class_id
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach ($students as $row) {
            $attendance_status = $this->input->post('status_' . $row['student_id']);

            $this->db->where('student_id', $row['student_id']);
            $this->db->where('date', $this->input->post('date'));

            $this->db->update('attendance', array('status' => $attendance_status));
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id, 'refresh');
    }
    $page_data['date'] = $date;
    $page_data['month'] = $month;
    $page_data['year'] = $year;
    $page_data['class_id'] = $class_id;

    $page_data['page_name'] = 'manage_attendance';
    $page_data['page_title'] = get_phrase('manage_daily_attendance');
    $this->load->view('backend/index', $page_data);
}

function attendance_selector() {
    redirect(base_url() . 'admin/manage_attendance/' . $this->input->post('date') . '/' .
            $this->input->post('month') . '/' .
            $this->input->post('year') . '/' .
            $this->input->post('class_id'), 'refresh');
}

/* Fee Category */

function fee_category($param1 = '', $param2 = '', $param3 = '') {

    $page_data['page_name'] = 'fee_category';
    $page_data['page_title'] = get_phrase('fee_category');
    $this->load->view('backend/index', $page_data);
}

/* Fee structure */

function fee_structure($param1 = '', $param2 = '', $param3 = '') {

    if ($param1 == 'create') {
        $data['class_id'] = $this->input->post('class_id');
        $data['fee_category_id'] = $this->input->post('fee_category_id');
        $data['amount'] = $this->input->post('amount');
        $data['date'] = $this->input->post('date');
        $data['created'] = date("Y-m-d");
        $this->db->insert('fee_structure', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/fee_structure/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['class_id'] = $this->input->post('class_id');
        $data['fee_category_id'] = $this->input->post('fee_category_id');
        $data['amount'] = $this->input->post('amount');
        $data['date'] = $this->input->post('date');

        $this->db->where('fee_structure_id', $param2);
        $this->db->update('fee_structure', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/fee_structure/', 'refresh');
    }
    if ($param1 == 'delete') {
        $this->db->where('fee_structure_id', $param2);
        $this->db->delete('fee_structure');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/fee_structure/', 'refresh');
    }
    $page_data['page_name'] = 'fee_structure';
    $page_data['page_title'] = get_phrase('fee_structure');
    $page_data['structures'] = $this->db->get("fee_structure")->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ****MANAGE BILLING / INVOICES WITH STATUS**** */

function takepayment($param1 = '') {
    $page_data['page_name'] = 'take_payment';
    $page_data['param1'] = $param1;
    $page_data['page_title'] = get_phrase('manage_invoice/take_payment');
    $this->load->view('backend/index', $page_data);
}

function payment_draft($param1 = '') {
    $page_data['page_name'] = 'fee_draft';
    $page_data["param1"] = $param1;
    $this->load->view("backend/admin/fee_draft", $page_data);
}

function invoice($param1 = '', $param2 = '', $param3 = '') {

    if ($param1 == 'create') {
        $data['student_id'] = $this->input->post('student_id');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['total_amount'] = $this->input->post('amount');
        $data['amount'] = $this->input->post('amount') - $this->input->post('concession');
        $data['amount_paid'] = $this->input->post('amount_paid');
        $data['concession'] = $this->input->post('concession');
        $data['due'] = $data['amount'] - $data['amount_paid'];
        $data['status'] = $this->input->post('status');
        $data['creation_timestamp'] = strtotime($this->input->post('date'));
        $current_batch = $this->db->get_where("batch", array("current_batch" => 1))->row_array();
        $data['batch_id'] = $current_batch["batch_id"];

        $this->db->insert('invoice', $data);
        $invoice_id = $this->db->insert_id();

        $data2['invoice_id'] = $invoice_id;
        $data2['student_id'] = $this->input->post('student_id');
        $data2['title'] = $this->input->post('title');
        $data2['description'] = $this->input->post('description');
        $data2['payment_type'] = 'income';
        $data2['method'] = $this->input->post('method');
        $data2['amount'] = $this->input->post('amount_paid');
        $data2['timestamp'] = strtotime($this->input->post('date'));

        $this->db->insert('payment', $data2);

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/takepayment/' . $invoice_id, 'refresh');
    }

    if ($param1 == 'do_update') {
        $data['student_id'] = $this->input->post('student_id');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['amount'] = $this->input->post('amount');
        $data['status'] = $this->input->post('status');
        $data['creation_timestamp'] = strtotime($this->input->post('date'));

        $this->db->where('invoice_id', $param2);
        $this->db->update('invoice', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/invoice', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('invoice', array(
                    'invoice_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'take_payment') {
        $data['invoice_id'] = $this->input->post('invoice_id');
        $data['student_id'] = $this->input->post('student_id');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['payment_type'] = 'income';
        $data['method'] = $this->input->post('method');
        $data['amount'] = $this->input->post('amount');
        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $this->db->insert('payment', $data);

        $data2['amount_paid'] = $this->input->post('amount');
        $this->db->where('invoice_id', $param2);
        $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
        $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
        $this->db->update('invoice');

        $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
        redirect(base_url() . 'admin/takepayment/' . $this->input->post('invoice_id'), 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('invoice_id', $param2);
        $this->db->delete('invoice');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/invoice', 'refresh');
    }
    $page_data['page_name'] = 'invoice';
    $page_data['page_title'] = get_phrase('manage_invoice/payment');
    $this->db->order_by('creation_timestamp', 'desc');
    $page_data['invoices'] = $this->db->get('invoice')->result_array();
    $this->load->view('backend/index', $page_data);
}

function getstudentfee() {
    $student_id = $this->input->get("student_id");
    $student = $this->db->get_where("student", array("student_id" => $student_id))->row_array();

    $class_id = $student["class_id"];
    $transport_id = $student["transport_id"];

    //tuition fee
    $fee_admission = $this->db->get_where("fee_structure", array("class_id" => $class_id, "fee_category_id" => 1))->row_array();

    //tuition fee
    $fee_tuition = $this->db->get_where("fee_structure", array("class_id" => $class_id, "fee_category_id" => 2))->row_array();

    //transport fee
    $fee_transport = $this->db->get_where("transport", array("transport_id" => $transport_id))->row_array();

    $text = "<table class='table table-bordered table-striped'>";
    $text .= "<tr><td><input type='checkbox' id='admission_fee' checked></td><td>Admission Fee </td><td>" . $fee_admission["amount"] . "</td></tr>";
    $text .= "<tr><td><input type='checkbox' id='tuition_fee' checked></td><td>Tuition Fee</td><td>" . $fee_tuition["amount"] . "</td></tr>";
    $text .= "<tr><td><input type='checkbox' id='transport_fee' checked></td><td>Transport Fee</td><td>" . $fee_transport["route_fare"] . "</td></tr>";
    $text .= "</table>";

    $response["text"] = $text;
    $response["admission_fee"] = $fee_admission["amount"];
    $response["tuition_fee"] = $fee_tuition["amount"];
    $response["transport_fee"] = $fee_transport["route_fare"];
    $response["total"] = $fee_admission["amount"] + $fee_tuition["amount"] + $fee_transport["route_fare"];
    echo json_encode($response);
}

/* * ********ACCOUNTING******************* */

function income($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    $page_data['page_name'] = 'income';
    $page_data['page_title'] = get_phrase('incomes');
    $this->db->order_by('creation_timestamp', 'desc');
    $page_data['invoices'] = $this->db->get('invoice')->result_array();
    $this->load->view('backend/index', $page_data);
}

function expense($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['title'] = $this->input->post('title');
        $data['expense_category_id'] = $this->input->post('expense_category_id');
        $data['description'] = $this->input->post('description');
        $data['payment_type'] = 'expense';
        $data['method'] = $this->input->post('method');
        $data['amount'] = $this->input->post('amount');
        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $this->db->insert('payment', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/expense', 'refresh');
    }

    if ($param1 == 'edit') {
        $data['title'] = $this->input->post('title');
        $data['expense_category_id'] = $this->input->post('expense_category_id');
        $data['description'] = $this->input->post('description');
        $data['payment_type'] = 'expense';
        $data['method'] = $this->input->post('method');
        $data['amount'] = $this->input->post('amount');
        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $this->db->where('payment_id', $param2);
        $this->db->update('payment', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/expense', 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('payment_id', $param2);
        $this->db->delete('payment');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/expense', 'refresh');
    }

    $page_data['page_name'] = 'expense';
    $page_data['page_title'] = get_phrase('expenses');
    $this->load->view('backend/index', $page_data);
}

function expense_category($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $this->db->insert('expense_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/expense_category');
    }
    if ($param1 == 'edit') {
        $data['name'] = $this->input->post('name');
        $this->db->where('expense_category_id', $param2);
        $this->db->update('expense_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/expense_category');
    }
    if ($param1 == 'delete') {
        $this->db->where('expense_category_id', $param2);
        $this->db->delete('expense_category');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/expense_category');
    }

    $page_data['page_name'] = 'expense_category';
    $page_data['page_title'] = get_phrase('expense_category');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE LIBRARY / BOOKS******************* */

function book($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['price'] = $this->input->post('price');
        $data['author'] = $this->input->post('author');
        $data['class_id'] = $this->input->post('class_id');
        $data['status'] = $this->input->post('status');
        $data['barcode_no'] = $this->input->post('barcode_no');
        $data['created'] = date("Y-m-d");
        $this->db->insert('book', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/book', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['price'] = $this->input->post('price');
        $data['author'] = $this->input->post('author');
        $data['class_id'] = $this->input->post('class_id');
        $data['status'] = $this->input->post('status');
        $data['barcode_no'] = $this->input->post('barcode_no');
        $this->db->where('book_id', $param2);
        $this->db->update('book', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/book', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('book', array(
                    'book_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('book_id', $param2);
        $this->db->delete('book');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/book', 'refresh');
    }
    $page_data['books'] = $this->db->get('book')->result_array();
    $page_data['page_name'] = 'book';
    $page_data['page_title'] = get_phrase('manage_library_books');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE ISSUE BOOK******************* */

function issue_book($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['barcode_no'] = $this->input->post('barcode_no');
        $data['user_id'] = $this->input->post('user_id');
        $data['user_type'] = $this->input->post('user_type');
        $data['start_date'] = $this->input->post('start_date');
        $data['end_date'] = $this->input->post('end_date');
        $data['created'] = date("Y-m-d");
        $this->db->insert('issue_book', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/issue_book', 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('issue_book_id', $param2);
        $this->db->delete('issue_book');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/issue_book', 'refresh');
    }
    $page_data['issue_books'] = $this->db->get('issue_book')->result_array();
    $page_data['page_name'] = 'issue_book';
    $page_data['page_title'] = get_phrase('manage_issue_book');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE RETURN BOOK******************* */

function return_book($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['barcode_no'] = $this->input->post('barcode_no');
        $data['user_id'] = $this->input->post('user_id');
        $data['user_type'] = $this->input->post('user_type');
        $data['start_date'] = $this->input->post('start_date');
        $data['end_date'] = $this->input->post('end_date');
        $data['created'] = date("Y-m-d");
        $this->db->insert('return_book', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/return_book', 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('return_book_id', $param2);
        $this->db->delete('return_book');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/issue_book', 'refresh');
    }
    $page_data['return_books'] = $this->db->get('return_book')->result_array();
    $page_data['page_name'] = 'return_book';
    $page_data['page_title'] = get_phrase('manage_return_book');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE TRANSPORT / VEHICLES / ROUTES******************* */

function transport($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['route_name'] = $this->input->post('route_name');
        $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
        $data['description'] = $this->input->post('description');
        $data['route_fare'] = $this->input->post('route_fare');
        $this->db->insert('transport', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/transport', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['route_name'] = $this->input->post('route_name');
        $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
        $data['description'] = $this->input->post('description');
        $data['route_fare'] = $this->input->post('route_fare');

        $this->db->where('transport_id', $param2);
        $this->db->update('transport', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/transport', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('transport', array(
                    'transport_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('transport_id', $param2);
        $this->db->delete('transport');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/transport', 'refresh');
    }
    $page_data['transports'] = $this->db->get('transport')->result_array();
    $page_data['page_name'] = 'transport';
    $page_data['page_title'] = get_phrase('manage_transport');
    $this->load->view('backend/index', $page_data);
}

function vehicle_detail($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['transport_id'] = $this->input->post('transport_id');
        $data['driver_id'] = $this->input->post('driver_id');
        $data['vehicle_name'] = $this->input->post('vehicle_name');
        $data['vehicle_no'] = $this->input->post('vehicle_no');
        $data['seats'] = $this->input->post('seats');
        $this->db->insert('vehicle_detail', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/vehicle_detail', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['transport_id'] = $this->input->post('transport_id');
        $data['driver_id'] = $this->input->post('driver_id');
        $data['vehicle_name'] = $this->input->post('vehicle_name');
        $data['vehicle_no'] = $this->input->post('vehicle_no');
        $data['seats'] = $this->input->post('seats');

        $this->db->where('vehicle_id', $param2);
        $this->db->update('vehicle_detail', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/vehicle_detail', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('vehicle_detail', array(
                    'vehicle_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('vehicle_id', $param2);
        $this->db->delete('vehicle_detail');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/vehicle_detail', 'refresh');
    }
    $page_data['vehicle_details'] = $this->db->query('select vehicle_detail.*,transport.*,driver_detail.* from vehicle_detail inner join transport on vehicle_detail.transport_id = transport.transport_id inner join driver_detail on vehicle_detail.driver_id = driver_detail.driver_id')->result_array();
    $page_data['page_name'] = 'vehicle_detail';
    $page_data['page_title'] = get_phrase('manage_vehicles');
    $this->load->view('backend/index', $page_data);
}

function driver_detail($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {

        $data['driver_name'] = $this->input->post('driver_name');
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');
        $this->db->insert('driver_detail', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/driver_detail', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['driver_name'] = $this->input->post('driver_name');
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');

        $this->db->where('driver_id', $param2);
        $this->db->update('driver_detail', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/driver_detail', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('driver_detail', array(
                    'driver_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('driver_id', $param2);
        $this->db->delete('driver_detail');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/driver_detail', 'refresh');
    }
    $page_data['driver_details'] = $this->db->get('driver_detail')->result_array();
    $page_data['page_name'] = 'driver_detail';
    $page_data['page_title'] = get_phrase('manage_drivers');
    $this->load->view('backend/index', $page_data);
}

function guardian_detail($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {

        $data['guardian_name'] = $this->input->post('guardian_name');
        $data['phone'] = $this->input->post('phone');

        $this->db->insert('guardian_detail', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/guardian_detail', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['guardian_detail'] = $this->input->post('guardian_detail');
        $data['phone'] = $this->input->post('phone');

        $this->db->where('guardian_id', $param2);
        $this->db->update('guardian_detail', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/guardian_detail', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('guardian_detail', array(
                    'guardian_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('guardian_id', $param2);
        $this->db->delete('guardian_detail');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/guardian_detail', 'refresh');
    }
    $page_data['guardian_details'] = $this->db->get('guardian_detail')->result_array();
    $page_data['page_name'] = 'guardian_detail';
    $page_data['page_title'] = get_phrase('manage_guardian');
    $this->load->view('backend/index', $page_data);
}

function hostel_complaint($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

    if ($param1 == 'delete') {
        $this->db->where('hostel_complaint_id', $param2);
        $this->db->delete('hostel_complaint');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/hostel_complaint', 'refresh');
    }
    //$page_data['hostel_complaints'] = $this->db->get('hostel_complaint')->result_array();
    $page_data['hostel_complaints'] = $this->db->query("select hostel_complaint.*,student.name from hostel_complaint inner join student on hostel_complaint.student_id = student.student_id")->result_array();
    $page_data['page_name'] = 'hostel_complaint';
    $page_data['page_title'] = get_phrase('manage_hostel_complaint');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE DORMITORY / HOSTELS / ROOMS ******************* */

function dormitory($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['guardian_id'] = $this->input->post('guardian_id');
        $data['name'] = $this->input->post('name');
        $data['number_of_room'] = $this->input->post('number_of_room');
        $data['description'] = $this->input->post('description');
        $this->db->insert('dormitory', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/dormitory', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['guardian_id'] = $this->input->post('guardian_id');
        $data['name'] = $this->input->post('name');
        $data['number_of_room'] = $this->input->post('number_of_room');
        $data['description'] = $this->input->post('description');

        $this->db->where('dormitory_id', $param2);
        $this->db->update('dormitory', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/dormitory', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                    'dormitory_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('dormitory_id', $param2);
        $this->db->delete('dormitory');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/dormitory', 'refresh');
    }
    $page_data['dormitories'] = $this->db->query('select dormitory.*, guardian_detail.* from dormitory inner join guardian_detail on dormitory.guardian_id = guardian_detail.guardian_id')->result_array();
    $page_data['page_name'] = 'dormitory';
    $page_data['page_title'] = get_phrase('manage_hostel');
    $this->load->view('backend/index', $page_data);
}

/* * *MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD* */

function noticeboard($param1 = '', $param2 = '', $param3 = '') {

    if ($param1 == 'create') {
        $data['notice_title'] = $this->input->post('notice_title');
        $data['notice'] = $this->input->post('notice');
        $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
        $this->db->insert('noticeboard', $data);

        $check_sms_send = $this->input->post('check_sms');

        if ($check_sms_send == 1) {
            // sms sending configurations

            $parents = $this->db->get('parent')->result_array();
            $students = $this->db->get('student')->result_array();
            $teachers = $this->db->get('teacher')->result_array();
            $date = $this->input->post('create_timestamp');
            $message = $data['notice_title'] . ' ';
            $message .= get_phrase('on') . ' ' . $date;
            foreach ($parents as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
            foreach ($students as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
            foreach ($teachers as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/noticeboard/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['notice_title'] = $this->input->post('notice_title');
        $data['notice'] = $this->input->post('notice');
        $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
        $this->db->where('notice_id', $param2);
        $this->db->update('noticeboard', $data);

        $check_sms_send = $this->input->post('check_sms');

        if ($check_sms_send == 1) {
            // sms sending configurations

            $parents = $this->db->get('parent')->result_array();
            $students = $this->db->get('student')->result_array();
            $teachers = $this->db->get('teacher')->result_array();
            $date = $this->input->post('create_timestamp');
            $message = $data['notice_title'] . ' ';
            $message .= get_phrase('on') . ' ' . $date;
            foreach ($parents as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
            foreach ($students as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
            foreach ($teachers as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/noticeboard/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                    'notice_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('notice_id', $param2);
        $this->db->delete('noticeboard');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'admin/noticeboard/', 'refresh');
    }
    $page_data['page_name'] = 'noticeboard';
    $page_data['page_title'] = get_phrase('manage_noticeboard');
    $page_data['notices'] = $this->db->get('noticeboard')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* private messaging */

function message($param1 = 'message_home', $param2 = '', $param3 = '') {

    if ($param1 == 'send_new') {
        $message_thread_code = $this->crud_model->send_new_private_message();
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(base_url() . 'admin/message/message_read/' . $message_thread_code, 'refresh');
    }

    if ($param1 == 'send_reply') {
        $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(base_url() . 'admin/message/message_read/' . $param2, 'refresh');
    }

    if ($param1 == 'message_read') {
        $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
        $this->crud_model->mark_thread_messages_read($param2);
    }

    $page_data['message_inner_page_name'] = $param1;
    $page_data['page_name'] = 'message';
    $page_data['page_title'] = get_phrase('private_messaging');
    $this->load->view('backend/index', $page_data);
}

/* * ***SITE/SYSTEM SETTINGS******** */

function system_settings($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'login', 'refresh');

    if ($param1 == 'do_update') {

        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_title');
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('address');
        $this->db->where('type', 'address');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('paypal_email');
        $this->db->where('type', 'paypal_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('currency');
        $this->db->where('type', 'currency');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('text_align');
        $this->db->where('type', 'text_align');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }
    if ($param1 == 'upload_logo') {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }
    if ($param1 == 'change_skin') {
        $data['description'] = $param2;
        $this->db->where('type', 'skin_colour');
        $this->db->update('settings', $data);
        $this->session->set_flashdata('flash_message', get_phrase('theme_selected'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }
    $page_data['page_name'] = 'system_settings';
    $page_data['page_title'] = get_phrase('system_settings');
    $page_data['settings'] = $this->db->get('settings')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ***SMS SETTINGS******** */

function sms_settings($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'login', 'refresh');
    if ($param1 == 'clickatell') {

        $data['description'] = $this->input->post('clickatell_user');
        $this->db->where('type', 'clickatell_user');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('clickatell_password');
        $this->db->where('type', 'clickatell_password');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('clickatell_api_id');
        $this->db->where('type', 'clickatell_api_id');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/sms_settings/', 'refresh');
    }

    if ($param1 == 'twilio') {

        $data['description'] = $this->input->post('twilio_account_sid');
        $this->db->where('type', 'twilio_account_sid');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('twilio_auth_token');
        $this->db->where('type', 'twilio_auth_token');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('twilio_sender_phone_number');
        $this->db->where('type', 'twilio_sender_phone_number');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/sms_settings/', 'refresh');
    }

    if ($param1 == 'active_service') {

        $data['description'] = $this->input->post('active_sms_service');
        $this->db->where('type', 'active_sms_service');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'admin/sms_settings/', 'refresh');
    }

    $page_data['page_name'] = 'sms_settings';
    $page_data['page_title'] = get_phrase('sms_settings');
    $page_data['settings'] = $this->db->get('settings')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ***LANGUAGE SETTINGS******** */

function manage_language($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'login', 'refresh');

    if ($param1 == 'edit_phrase') {
        $page_data['edit_profile'] = $param2;
    }
    if ($param1 == 'update_phrase') {
        $language = $param2;
        $total_phrase = $this->input->post('total_phrase');
        for ($i = 1; $i < $total_phrase; $i++) {
            //$data[$language]	=	$this->input->post('phrase').$i;
            $this->db->where('phrase_id', $i);
            $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
        }
        redirect(base_url() . 'admin/manage_language/edit_phrase/' . $language, 'refresh');
    }
    if ($param1 == 'do_update') {
        $language = $this->input->post('language');
        $data[$language] = $this->input->post('phrase');
        $this->db->where('phrase_id', $param2);
        $this->db->update('language', $data);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'admin/manage_language/', 'refresh');
    }
    if ($param1 == 'add_phrase') {
        $data['phrase'] = $this->input->post('phrase');
        $this->db->insert('language', $data);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'admin/manage_language/', 'refresh');
    }
    if ($param1 == 'add_language') {
        $language = $this->input->post('language');
        $this->load->dbforge();
        $fields = array(
            $language => array(
                'type' => 'LONGTEXT'
            )
        );
        $this->dbforge->add_column('language', $fields);

        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'admin/manage_language/', 'refresh');
    }
    if ($param1 == 'delete_language') {
        $language = $param2;
        $this->load->dbforge();
        $this->dbforge->drop_column('language', $language);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

        redirect(base_url() . 'admin/manage_language/', 'refresh');
    }
    $page_data['page_name'] = 'manage_language';
    $page_data['page_title'] = get_phrase('manage_language');
    //$page_data['language_phrases'] = $this->db->get('language')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ***BACKUP / RESTORE / DELETE DATA PAGE********* */

function backup_restore($operation = '', $type = '') {

    if ($operation == 'create') {
        $this->crud_model->create_backup($type);
    }
    if ($operation == 'restore') {
        $this->crud_model->restore_backup();
        $this->session->set_flashdata('backup_message', 'Backup Restored');
        redirect(base_url() . 'admin/backup_restore/', 'refresh');
    }
    if ($operation == 'delete') {
        $this->crud_model->truncate($type);
        $this->session->set_flashdata('backup_message', 'Data removed');
        redirect(base_url() . 'admin/backup_restore/', 'refresh');
    }

    $page_data['page_info'] = 'Create backup / restore from backup';
    $page_data['page_name'] = 'backup_restore';
    $page_data['page_title'] = get_phrase('manage_backup_restore');
    $this->load->view('backend/index', $page_data);
}

/* * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

function manage_profile($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'login', 'refresh');
    if ($param1 == 'update_profile_info') {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');

        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
        redirect(base_url() . 'admin/manage_profile/', 'refresh');
    }
    if ($param1 == 'change_password') {
        $data['password'] = $this->input->post('password');
        $data['new_password'] = $this->input->post('new_password');
        $data['confirm_new_password'] = $this->input->post('confirm_new_password');

        $current_password = $this->db->get_where('admin', array(
                    'admin_id' => $this->session->userdata('admin_id')
                ))->row()->password;
        if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', array(
                'password' => $data['new_password']
            ));
            $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
        }
        redirect(base_url() . 'admin/manage_profile/', 'refresh');
    }
    $page_data['page_name'] = 'manage_profile';
    $page_data['page_title'] = get_phrase('manage_profile');
    $page_data['edit_data'] = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->result_array();
    $this->load->view('backend/index', $page_data);
}

}
