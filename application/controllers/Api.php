<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header('Access-Control-Allow-Origin: *');
    }

    function getEvents() {
        $response = array();
        $notices = $this->db->get('noticeboard')->result_array();
        foreach ($notices as $notice) {
            $response[] = $notice;
        }
        echo json_encode(array("data" => $response));
    }

    function getHolidays() {
        $response = array();
        $holidays = $this->db->get('holidays')->result_array();
        foreach ($holidays as $holiday) {
            $response[] = $holiday;
        }
        echo json_encode(array("data" => $response));
    }

    function getStudyMaterial() {
        $class_id = $_GET["class_id"];
        $response = array();
        $materials = $this->db->get_where('document', array("class_id" => $class_id))->result_array();
        foreach ($materials as $material) {
            $response[] = $material;
        }
        echo json_encode(array("data" => $response));
    }

    function getAttendanceClasses() {
        $teacher_id = $_GET["teacher_id"];
        $response = array();
        $classes = $this->db->query("SELECT class.class_id,class.name as 'class_name',class.name_numeric,section.section_id,section.name as 'section_name',section.nick_name FROM `class` inner join section on class.class_id = section.class_id where section.teacher_id = '" . $teacher_id . "'")->result_array();
        foreach ($classes as $class) {
            $response[] = $class;
        }
        echo json_encode(array("data" => $response));
    }

    function getStudentAttendance() {
        $class_id = $_GET["class_id"];
        $section_id = $_GET["section_id"];
        $response = array();
        $classes = $this->db->query("SELECT * FROM `student` WHERE class_id='" . $class_id . "' and section_id = '" . $section_id . "'")->result_array();
        foreach ($classes as $class) {
            $response[] = $class;
        }
        echo json_encode(array("data" => $response));
    }

    function submitAttendance() {
        $class_id = $_GET["class_id"];
        $section_id = $_GET["section_id"];

        $stus = $_GET["stus"];

        $absent_students = explode(";", $stus);
        foreach ($absent_students as $ab_stu) {
            $absent_records = $this->db->get_where("attendance", array("student_id" => $ab_stu, "date" => date("Y-m-d")))->num_rows();
            if ($absent_records == 0) {
                $this->db->insert("attendance", array("status" => 2, "student_id" => $ab_stu, "date" => date("Y-m-d")));
            }
        }


        $allstudents = array();

        $classes = $this->db->query("SELECT * FROM `student` WHERE class_id='" . $class_id . "' and section_id = '" . $section_id . "'")->result_array();

        foreach ($classes as $class) {
            $allstudents[] = $class["student_id"];
        }

        $presentstudents = array_diff($allstudents, $absent_students);
        foreach ($presentstudents as $pres_stu) {
            $present_records = $this->db->get_where("attendance", array("student_id" => $pres_stu, "date" => date("Y-m-d")))->num_rows();
            if ($present_records == 0) {
                $this->db->insert("attendance", array("status" => 1, "student_id" => $pres_stu, "date" => date("Y-m-d")));
            }
        }
        $json_data = array();
        $json_data["responseCode"] = 200;
        $json_data["success"] = true;
        $json_data["message"] = "Success";
        $json_data["data"] = array();
        echo json_encode($json_data);
    }

    function getClassStudents() {
        $class_id = $_GET["class_id"];
        $section_id = $_GET["section_id"];
        $result = $this->db->get_where("student", array("class_id" => $class_id, "section_id" => $section_id))->result_array();
        $students = array();
        foreach ($result as $row) {
            $students[] = $row;
        }
        $json_data = array();
        $json_data["responseCode"] = 200;
        $json_data["success"] = true;
        $json_data["message"] = "Success";
        $json_data["data"] = ($students);
        echo json_encode($json_data);
    }

    function getStudentAttendanceByDate() {
        $user_id = $_GET["user_id"];
        $date = $_GET["date"];
        $result = $this->db->get_where("attendance", array("student_id" => $user_id, "date" => $date))->row_array();
        /* $students = array();
          foreach($result as $row)
          {
          $students[] = $row;
          } */
        if ($result) {
            $json_data = array();
            $json_data["responseCode"] = 200;
            $json_data["success"] = true;
            $json_data["message"] = "Success";
            $json_data["data"] = ($result);
            echo json_encode($json_data);
        } else {
            $this->failed();
        }
    }

    function userLogin() {
        $role = $_GET["role"];
        $username = $_GET["username"];
        $password = $_GET["password"];
        $query = "";
        if ($role == "1") {
            $query = $this->db->get_where("teacher", array("email" => $username, "password" => $password));
        }
        if ($role == "2") {
            $query = $this->db->get_where("student", array("admission_no" => $username, "password" => $password));
        }
        if ($role == "3") {
            $query = "select * from students where student_uname='" . mysql_real_escape_string($username) . "' and student_pass='" . mysql_real_escape_string($password) . "'";
        }


        $result = $query->row_array();

        if ($query->num_rows() > 0) {
            $json_data = array();
            $json_data["responseCode"] = 200;
            $json_data["success"] = true;
            $json_data["message"] = "Success";
            $json_data["data"] = array(($result));
            echo json_encode($json_data);
        } else {
            $this->failed();
        }
    }

    function studenttasks() {

        $class_id = $_GET["class_id"];
        $section_id = $_GET["section_id"];
        $query = $this->db->query("select tasks.*,subject.name from tasks inner join subject on tasks.subject_id = subject.subject_id where tasks.class_id='" . $class_id . "' and tasks.section_id='" . $section_id . "' order by tasks.task_id desc");
        $result = $query->result_array();
        $tasks = array();
        foreach ($result as $row) {
            $tasks[] = $row;
        }
        if ($query->num_rows() > 0) {
            $json_data = array();
            $json_data["responseCode"] = 200;
            $json_data["success"] = true;
            $json_data["message"] = "Success";
            $json_data["data"] = ($tasks);
            echo json_encode($json_data);
        } else {
            $this->failed();
        }
    }
    function studentinvoice() {

        $student_id = $_GET["student_id"];
       
        $query = $this->db->get_where("invoice",array("student_id"=>$student_id));
        $result = $query->result_array();
        $invoices = array();
        foreach ($result as $row) {
            $invoices[] = $row;
        }
        if ($query->num_rows() > 0) {
            $json_data = array();
            $json_data["responseCode"] = 200;
            $json_data["success"] = true;
            $json_data["message"] = "Success";
            $json_data["data"] = ($invoices);
            echo json_encode($json_data);
        } else {
            $this->failed();
        }
    }

    private function failed() {
        $json_data = array();
        $json_data["responseCode"] = 200;
        $json_data["success"] = false;
        $json_data["message"] = "Failed";
        $json_data["result"] = array();
        echo json_encode($json_data);
    }

}
