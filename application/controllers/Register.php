<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();

         $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default function, redirects to login page if no admin logged in yet** */

    public function index() {
        $this->load->view("register");
    }

   public function create()
   {
  
   	$data['aadhar_card_no'] = $this->input->post('aadhar_card_no');
   	$data['name'] = $this->input->post('name');
   	$data['father_name'] = $this->input->post('father_name');
   	$data['mother_name'] = $this->input->post('mother_name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
          
            $data['class_id'] = $this->input->post('class_id');
            $data['batch_id'] = $this->input->post('batch_id');
            if ($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
$data['created'] = date("Y-m-d");
           
            $this->db->insert('student', $data);
            
            $student_id = $this->db->insert_id();
            
            if(!empty($_FILES['userfile']['name']))
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            
            if(!empty($_FILES['aadhar_card_file']['name']))
            move_uploaded_file($_FILES['aadhar_card_file']['tmp_name'], 'uploads/aadhar_card/' . $student_id . '.jpg');
            
            if(!empty($_FILES['medical_certificate']['name']))
            move_uploaded_file($_FILES['medical_certificate']['tmp_name'], 'uploads/medical_certificate/' . $student_id . '.jpg');
            
            if(!empty($_FILES['birth_certificate']['name']))
            move_uploaded_file($_FILES['birth_certificate']['tmp_name'], 'uploads/birth_certificate/' . $student_id . '.jpg');
            
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'register/success', 'refresh');
   }
   public function success()
   {
   	echo "<br/><br/><br/><br/><br/><br/><center>";
   	echo "<img src='".base_url()."success.png'/>";
   	echo "</center>";
   }
}

