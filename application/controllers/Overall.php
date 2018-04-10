<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Overall extends CI_Controller {

    public function index(){
        if($this->islogged()){
            $this->load->model('RankingModel');
            $ranking = new RankingModel();
                     
            $page = $this->getPage();
            $status = $this->getstatus();
            $delivery = $ranking->listing(0);
            $msg = array("ranking" => $delivery, "page" => $page, "status" => $status['status_mercado']);
            
            $this->load->view('template/menu', $msg);
            $this->load->view('overall', $msg);
            $this->load->view('template/footer');
        }
    }
    
    public function getPage() {
        $current = array("id" => 3, "page" => "user");
        return array("current" => $current);
    }
}