<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index(){
        if($this->islogged()){
            
            $this->load->model('AnnualviewModel');
            $this->load->model('RankingModel');
            $anual = new AnnualviewModel();
            $ranking = new RankingModel();
            
            $delivery = $ranking->listing(2);
            $dt = date('n');
            
            if($dt>4){
                $avdata = $anual->search($dt-1);
            }
            else{
                $avdata = $anual->search($dt);
            }
            
            $json = $this->getstatus();
            
            switch ($json['status_mercado']) {
                case 1:
                    $type = "success";
                    $icon = "unlock";
                    $message = "Aberto";
                    break;
                case 2:
                    $type = "danger";
                    $icon = "lock";
                    $message = "Fechado";
                    break;
                case 4:
                    $type = "warning";
                    $icon = "lock";
                    $message = "em Manutenção";
                    break;
                default:
                    $type = "success";
                    $icon = "unlock";
                    $message = "Aberto";
                    break;
            }
            
            $msg = array("round" => $json['rodada_atual'], 
                        "status" => $json['status_mercado'],
                        "ranking" => $delivery,
                        "type" => $type, "icon" => $icon, 
                        "avdata" => $avdata,
                        "message" => $message);
            
            
            $this->load->view('template/menu', $msg);
            $this->load->view('home', $msg);
            $this->load->view('template/footer');
        }
    }
    
    public function getstatus() {
        
        $url = 'https://api.cartolafc.globo.com/mercado/status';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
    }
}