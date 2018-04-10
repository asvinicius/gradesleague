<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

    public function index(){
        if($this->islogged()){
            $this->load->model('BankModel');
            $bank = new BankModel();
            
            $page = $this->getPage();
            $status = $this->getstatus();
            $delivery = $bank->listing();
            
            $msg = array("bank" => $delivery, "page" => $page, "status" => $status['status_mercado']);
            
            $this->load->view('template/menu', $msg);
            $this->load->view('bank', $msg);
            $this->load->view('template/footer');
        }
    }
    
    public function add($bankid) {
        $this->load->model('BankModel');
        $bank = new BankModel();
        
        $data = $bank->search($bankid);
        
        $bankdata['bankid'] = $data['bankid'];
        $bankdata['team'] = $data['team'];
        $bankdata['balance'] = $data['balance']+1;
        
        if($bank->update($bankdata)){
            redirect(base_url('bank'));
        }
    }
    
    public function getPage() {
        $current = array("id" => 5, "page" => "user");
        return array("current" => $current);
    }
}