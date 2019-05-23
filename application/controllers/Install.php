<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Install extends CI_Controller {
    /*     * *default function, redirects to login page if no admin logged in yet** */

    public function index() {

//        $this->load->view('backend/install');
//        $this->load->view('l');
        redirect("login");
    }

}
