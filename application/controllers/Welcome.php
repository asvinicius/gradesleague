<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index(){
        if($this->islogged()){
            $this->load->view('template/menu');
            $this->load->view('home');
            $this->load->view('template/footer');
        }
    }
}