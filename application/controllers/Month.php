<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Month extends CI_Controller {

    public function index(){
        if($this->islogged()){
            $this->load->model('RankingModel');
            $ranking = new RankingModel();
                     
            $page = $this->getPage();
            $delivery = $ranking->listing(1);
            $msg = array("ranking" => $delivery);
            
            $this->load->view('template/menu', $page);
            $this->load->view('month', $msg);
            $this->load->view('template/footer');
        }
    }
    
    public function getPage() {
        $current = array("id" => 4, "page" => "user");
        return array("current" => $current);
    }
}