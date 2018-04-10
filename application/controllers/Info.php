<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

    public function index(){
        if($this->islogged()){
            $this->load->model('TeamModel');
            $this->load->model('AnnualviewModel');
            $team = new TeamModel();
            $anual = new AnnualviewModel();
            
            $teams = $team->listing();
            $avdata = $anual->listing();
            
            $page = $this->getPage();
            $status = $this->getstatus();
            $msg = array("teams" => $teams, "avdata" => $avdata, "page" => $page, "status" => $status['status_mercado']);
            
            $this->load->view('template/menu', $msg);
            $this->load->view('info', $msg);
            $this->load->view('template/footer');
        }
    }
    
    public function detail($avid) {
        if($this->islogged()){
            $this->load->model('AnnualviewModel');
            $this->load->model('MonthlyviewModel');
            $anual = new AnnualviewModel();
            $monthly = new MonthlyviewModel();
            
            $avdata = $anual->search($avid);
            $mvdata = $monthly->listing($avid);
            
            $page = $this->getPage();
            $msg = array("avdata" => $avdata, "mvdata" => $mvdata);
            
            $this->load->view('template/menu', $page);
            $this->load->view('detail', $msg);
            $this->load->view('template/footer');
        }
    }
    
    public function getPage() {
        $current = array("id" => 6, "page" => "user");
        return array("current" => $current);
    }
}