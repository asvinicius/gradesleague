<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

    public function index(){
        if($this->islogged()){
            $this->load->model('TeamModel');
            $team = new TeamModel();
            
            $teams = $team->listing();
            $msg = array("teams" => $teams);
            
            $this->load->view('template/menu');
            $this->load->view('info', $msg);
            $this->load->view('template/footer');
        }
    }
}