<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Squad extends CI_Controller {

    public function index(){
        if($this->islogged()){       
            $jstat = $this->getstatus();
            $page = $this->getPage();
                            
                $msg = array( 
                    "page" => $page, 
                    "status" => $jstat['status_mercado']);

                $this->load->view('template/menu', $msg);
                $this->load->view('squad', $msg);
                $this->load->view('template/footer');
            
            /*if($jstat['status_mercado'] == 2){
                $json = $this->getleague();
                
                $partial = $this->partround();
                $month = $this->partmonth($partial, $json);
                $overall = $this->partchamp($partial, $json);
                
                $page = $this->getPage();
                $status = $this->getstatus();
                
                $msg = array("partial" => $partial, 
                    "month" => $month, 
                    "overall" => $overall, 
                    "page" => $page, 
                    "status" => $status['status_mercado']);

                $this->load->view('template/menu', $msg);
                $this->load->view('partial', $msg);
                $this->load->view('template/footer');
            }
            else{
                redirect(base_url('welcome'));
            }*/
        }
    }
    
    public function partround(){
        $this->load->model('TeamModel');
        $team = new TeamModel();
        
        $finished = $team->listing();
        $final = 0;
        foreach ($finished as $value) {
            $final = $final+1;
        }
        
        $squad = array();
        
        $c = 0;
        foreach ($finished as $value) {
            for($i = 0; $i<$final; $i++){
                if($c == $i){
                    $squad[$i] = $this->getSquad($value->teamslug);
                }
            }
            $c = $c+1;
        }
        
        $t = array();
        
        for($i = 0; $i<$final; $i++){
            $t[$i] = array(
                "nome" => $squad[$i]['time']['nome'],
                "cartoleiro" => $squad[$i]['time']['nome_cartola'],
                "parcial" => $this->getPartial($squad[$i]['atletas'], $squad[$i]['capitao_id']));
        }
                
        for($i = 0; $i<$final-1; $i++){
            for($j = $i+1; $j<$final; $j++){
                if($t[$j]['parcial'] > $t[$i]['parcial']){
                    $aux = $t[$i];
                    $t[$i] = $t[$j];
                    $t[$j] = $aux;
                }
            }
        }
        
        $teams = array(
                "t1" => $t[0],
                "t2" => $t[1],
                "t3" => $t[2],
                "t4" => $t[3],
                "t5" => $t[4]);
                //"t6" => $t[5]
        
        return $teams;
    }
    public function partmonth($partial, $json){
        
        $t = array();
        
        $c = 0;        
        foreach ($json['times'] as $equipe) {
            $t[$c] = $equipe;
            $c++;
        }
        
        foreach ($partial as $team) {
            for($i = 0; $i<$c; $i++){
                if($t[$i]['nome'] == $team['nome']){
                    $t[$i]['pontos']['mes'] = $t[$i]['pontos']['mes'] + $team['parcial'];
                }
            }
        }
        
        for($i = 0; $i<$c-1; $i++){
            for($j = $i+1; $j<$c; $j++){
                if($t[$j]['pontos']['mes'] > $t[$i]['pontos']['mes']){
                    $aux = $t[$i];
                    $t[$i] = $t[$j];
                    $t[$j] = $aux;
                }
            }
        }
        
        for($i = 0; $i<$c; $i++){
            $t[$i]['pontos']['mes'] = number_format($t[$i]['pontos']['mes'], 2);
        }
        
        
        $month = array(
                "t1" => $t[0],
                "t2" => $t[1],
                "t3" => $t[2],
                "t4" => $t[3],
                "t5" => $t[4]);
                //"t6" => $t[5]
        
        return $month;
    }
    public function partchamp($partial, $json){
        
        $t = array();
        
        $c = 0;        
        foreach ($json['times'] as $equipe) {
            $t[$c] = $equipe;
            $c++;
        }
        
        foreach ($partial as $team) {
            for($i = 0; $i<$c; $i++){
                if($t[$i]['nome'] == $team['nome']){
                    $t[$i]['pontos']['campeonato'] = $t[$i]['pontos']['campeonato'] + $team['parcial'];
                }
            }
        }
        
        for($i = 0; $i<$c-1; $i++){
            for($j = $i+1; $j<$c; $j++){
                if($t[$j]['pontos']['campeonato'] > $t[$i]['pontos']['campeonato']){
                    $aux = $t[$i];
                    $t[$i] = $t[$j];
                    $t[$j] = $aux;
                }
            }
        }
        
        for($i = 0; $i<$c; $i++){
            $t[$i]['pontos']['campeonato'] = number_format($t[$i]['pontos']['campeonato'], 2);
        }
        
        $overall = array(
                "t1" => $t[0],
                "t2" => $t[1],
                "t3" => $t[2],
                "t4" => $t[3],
                "t5" => $t[4]);
                //"t6" => $t[5]
        
        return $overall;
    }
    
    
    public function getPartial($atletas, $capita) {
        $url = 'https://api.cartolafc.globo.com/atletas/pontuados';
        
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
        
        $parcial = 0;
        
        foreach ($atletas as $atleta){
            foreach ($json['atletas'] as $verify) {
              if($atleta['apelido'] == $verify['apelido'] && $atleta['clube_id'] == $verify['clube_id']){
                  if($atleta['atleta_id'] == $capita){
                      $parcial = $parcial + ($verify['pontuacao']*2);
                  }
                  else{
                      $parcial = $parcial + $verify['pontuacao'];
                  }
              }
            }
        }
        return $parcial; 
        
    }
    
    public function getSquad($slug) {
        
        $url = 'https://api.cartolafc.globo.com/time/slug/'.$slug;
        
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
    
    public function getleague() {
        
        $url = 'https://api.cartolafc.globo.com/auth/liga/gt-grades-league-2018';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
          'X-GLB-Token: '.$this->session->userdata('glbId'),
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
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
    
    public function getPage() {
        $current = array("id" => 2, "page" => "user");
        return array("current" => $current);
    }
}