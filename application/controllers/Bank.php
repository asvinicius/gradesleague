<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

    public function index(){
        if($this->islogged()){
            
            $page = $this->getPage();
            
            $this->load->view('template/menu', $page);
            $this->load->view('bank');
            $this->load->view('template/footer');
        }
    }
    
    public function getPage() {
        $current = array("id" => 5, "page" => "user");
        return array("current" => $current);
    }
}