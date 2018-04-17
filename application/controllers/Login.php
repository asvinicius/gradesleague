<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index(){
        if ($this->session->userdata('logged') === TRUE) {
            redirect(base_url('welcome'));
        } else {
            $this->load->view('login');
        }
    }
    
    public function signin() {
        
        header('Content-type: application/json');
        
        $email = $this->input->get("email");
        $password = $this->input->get("password");
        $serviceId = 4728;
        
        $url = 'https://login.globo.com/api/authentication';
        
        $jsonAuth = array(
          'captcha' => '',
          'payload' => array(
            'email' => $email,
            'password' => $password,
            'serviceId' => $serviceId
          )
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonAuth));
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
          die(curl_error($ch));
        }
        curl_close($ch);
        
        $parseJson = json_decode($result, TRUE);
        
        if($parseJson['id'] == "Authenticated"){            
            $session = array(
                'glbId' => $parseJson['glbId'],
                'logged' => TRUE
            );
            $this->session->set_userdata($session);
            if($this->update()){
                redirect(base_url('login'));
            }
        }else{            
            redirect(base_url('login'));
        }      
    }
    
    public function update() {
        $this->load->model('StatusModel');
        $status = new StatusModel();
        
        $laststatus = $status->search();
        $json = $this->getstatus();
        
        if($json['status_mercado'] == 4){
            return true;
        }
        else{
            if($json['rodada_atual'] == $laststatus['currentround']){
                if($json['status_mercado'] == $laststatus['marketstatus']){
                    return true;
                }
                else{
                    $this->checkstatus();
                    return true;
                }
            }
            else{
                $this->updatedatabase($json);
                return true;
            }
        }
    }
    
    public function updatedatabase($json) {
        $league = $this->getleague();
        
        $this->checknewteam($league);
        $this->checkranking($league, $json);
        $this->checkinfo($json);
        $this->checkstatus();
    }
    
    public function checknewteam($league) {
        $this->load->model('TeamModel');
        $this->load->model('BankModel');
        $team = new TeamModel();
        $bank = new BankModel();
        
        foreach ($league['times'] as $leagueteam) {
            $aux = $team->search($leagueteam['time_id']);
            
            if(!$aux){
                $teamdata['teamid'] = $leagueteam['time_id'];
                $teamdata['name'] = $leagueteam['nome'];
                $teamdata['coach'] = $leagueteam['nome_cartola'];
                $teamdata['teamslug'] = $leagueteam['slug'];
                $teamdata['nickcoach'] = $leagueteam['nome_cartola'];
                $teamdata['vr'] = 0;
                $teamdata['vm'] = 0;
                $teamdata['lr'] = 0;
                $teamdata['lm'] = 0;

                if($team->save($teamdata)){
                    $bankdata['bankid'] = null;
                    $bankdata['team'] = $leagueteam['time_id'];
                    $bankdata['balance'] = -1;

                    if($bank->save($bankdata)){
                        
                    }
                }
            }
        }
    }
    
    public function checkranking($league, $json) {
        $this->load->model('RankingModel');
        $ranking = new RankingModel();
        
        foreach ($league['times'] as $leagueteam) {
            $aux = $ranking->search($leagueteam['time_id'], 0);
            $aux2 = $ranking->search($leagueteam['time_id'], 1);
            $aux3 = $ranking->search($leagueteam['time_id'], 2);
            
            if($aux){
                $rankingdata['rankingid'] = $aux['rankingid'];
                $rankingdata['team'] = $aux['team'];
                $rankingdata['rating'] = $leagueteam['pontos']['campeonato'];
                $rankingdata['patrimony'] = $leagueteam['patrimonio'];
                $rankingdata['type'] = $aux['type'];

                if($ranking->update($rankingdata)){
                }
            }else{
                $rankingdata['rankingid'] = null;
                $rankingdata['team'] = $leagueteam['time_id'];
                $rankingdata['rating'] = $leagueteam['pontos']['campeonato'];
                $rankingdata['patrimony'] = $leagueteam['patrimonio'];
                $rankingdata['type'] = 0;

                if($ranking->save($rankingdata)){
                }
            }
            if($aux2){
                $rankingdata['rankingid'] = $aux2['rankingid'];
                $rankingdata['team'] = $aux2['team'];
                $rankingdata['rating'] = $leagueteam['pontos']['mes'];
                $rankingdata['patrimony'] = $leagueteam['patrimonio'];
                $rankingdata['type'] = $aux2['type'];

                if($ranking->update($rankingdata)){
                }
            }else{
                $rankingdata['rankingid'] = null;
                $rankingdata['team'] = $leagueteam['time_id'];
                $rankingdata['rating'] = $leagueteam['pontos']['mes'];
                $rankingdata['patrimony'] = $leagueteam['patrimonio'];
                $rankingdata['type'] = 1;

                if($ranking->save($rankingdata)){
                }
            }
            if($aux3){
                $rankingdata['rankingid'] = $aux3['rankingid'];
                $rankingdata['team'] = $aux3['team'];
                $rankingdata['rating'] = $leagueteam['pontos']['rodada'];
                $rankingdata['patrimony'] = $leagueteam['patrimonio'];
                $rankingdata['type'] = $aux3['type'];

                if($ranking->update($rankingdata)){
                }
            }else{
                $rankingdata['rankingid'] = null;
                $rankingdata['team'] = $leagueteam['time_id'];
                $rankingdata['rating'] = $leagueteam['pontos']['rodada'];
                $rankingdata['patrimony'] = $leagueteam['patrimonio'];
                $rankingdata['type'] = 2;

                if($ranking->save($rankingdata)){
                }
            }
        }
    }
    
    public function checkinfo($json) {
        $this->load->model('TeamModel');
        $this->load->model('AnnualviewModel');
        $this->load->model('MonthlyviewModel');
        $this->load->model('RoundsModel');
        $this->load->model('RankingModel');
        $this->load->model('BankModel');
        $team = new TeamModel();
        $annual = new AnnualviewModel();
        $monthly = new MonthlyviewModel();
        $rounds = new RoundsModel();
        $ranking = new RankingModel();
        $bank = new BankModel();
        
        $round = $rounds->search($json['rodada_atual']);
        
        $pastmv = $monthly->search($round['roundsid']-1);
        $lastround = $ranking->listing(2);
        
        $pastmvdata['mvid'] = $pastmv['mvid'];
        $pastmvdata['month'] = $pastmv['month'];
        
        $final = 0;
        foreach ($lastround as $value) {
            $final = $final+1;
        }
        $cont = 1;
        foreach ($lastround as $value) {
            switch ($cont) {
                case 1:
                    $obj = $team->search($value->team);
                    $this->setroundwin($obj);
                    $pastmvdata['winner'] = $obj['nickcoach'];
                    break;
                case $final:
                    $obj = $team->search($value->team);
                    $this->setroundlose($obj);
                    $pastmvdata['loser'] = $obj['nickcoach'];
                    break;
            }
            $cont++;
        }
        if($monthly->update($pastmvdata)){
            
        }
        
        $mvdata['mvid'] = $round['roundsid'];
        $mvdata['month'] = $round['month'];
        $mvdata['winner'] = "Não definido";
        $mvdata['loser'] = "Não definido";
        
        if($monthly->save($mvdata)){
            
        }
        
        $anvw = $annual->search($round['month']);
        
        if($anvw){
            $avdata['avid'] = $anvw['avid'];
            $avdata['description'] = $anvw['description'];
            $avdata['rounds'] = $anvw['rounds']+1;
            $avdata['winner'] = $anvw['winner'];
            $avdata['loser'] = $anvw['loser'];

            if($annual->update($avdata)){
                
            }
        }
        else{
            $pastav = $annual->search($round['month']-1);
            $lastmonth = $ranking->listing(1);
            
            $pastavdata['avid'] = $pastav['avid'];
            $pastavdata['description'] = $pastav['description'];
            $pastavdata['rounds'] = $pastav['rounds'];

            $final = 0;
            foreach ($lastmonth as $value) {
                $final = $final+1;
            }
            $cont = 1;
            foreach ($lastmonth as $value) {
                switch ($cont) {
                    case 1:
                        $obj = $team->search($value->team);
                        $this->setmonthwin($obj);
                        $pastavdata['winner'] = $obj['nickcoach'];
                        break;
                    case $final:
                        $obj = $team->search($value->team);
                        $this->setmonthlose($obj);
                        $pastavdata['loser'] = $obj['nickcoach'];
                        break;
                }
                $cont++;
            }
            
            if($annual->update($pastavdata)){
                
            }
            
            $avdata['avid'] = $round['month'];
            $desc = null;
            switch ($round['month']) {
                case 5:
                    $desc = "Maio";
                    break;
                case 6:
                    $desc = "Junho";
                    break;
                case 7:
                    $desc = "Julho";
                    break;
                case 8:
                    $desc = "Agosto";
                    break;
                case 9:
                    $desc = "Setembro";
                    break;
                case 10:
                    $desc = "Outubro";
                    break;
                case 11:
                    $desc = "Novembro";
                    break;
                case 12:
                    $desc = "Dezembro";
                    break;
                default:
                    $desc = "Abril";
                    break;
            }
            $avdata['description'] = $desc;
            $avdata['rounds'] = 1;
            $avdata['winner'] = "Não definido";
            $avdata['loser'] = "Não definido";

            if($annual->save($avdata)){
                
            }
            
            $aux = 1;
            while($bank->search($aux) != null){
                $bd = $bank->search($aux);
                $bankdata['bankid'] = $bd['bankid'];
                $bankdata['team'] = $bd['team'];
                $bankdata['balance'] = $bd['bankid']-1;
                
                if($bank->update($bankdata)){
                    $aux++;
                }
            }
            
        }
    }
    
    public function setroundwin($obj) {
        $this->load->model('TeamModel');
        $team = new TeamModel();
        
        $teamdata['teamid'] = $obj['teamid'];
        $teamdata['name'] = $obj['name'];
        $teamdata['coach'] = $obj['coach'];
        $teamdata['teamslug'] = $obj['teamslug'];
        $teamdata['nickcoach'] = $obj['nickcoach'];
        $teamdata['vr'] = $obj['vr']+1;
        $teamdata['vm'] = $obj['vm'];
        $teamdata['lr'] = $obj['lr'];
        $teamdata['lm'] = $obj['lm'];
        
        if($team->update($teamdata)){
            
        }
    }
    
    public function setroundlose($obj) {
        $this->load->model('TeamModel');
        $team = new TeamModel();
        
        $teamdata['teamid'] = $obj['teamid'];
        $teamdata['name'] = $obj['name'];
        $teamdata['coach'] = $obj['coach'];
        $teamdata['teamslug'] = $obj['teamslug'];
        $teamdata['nickcoach'] = $obj['nickcoach'];
        $teamdata['vr'] = $obj['vr'];
        $teamdata['vm'] = $obj['vm'];
        $teamdata['lr'] = $obj['lr']+1;
        $teamdata['lm'] = $obj['lm'];
        
        if($team->update($teamdata)){
            
        }
    }
    
    public function setmonthwin($obj) {
        $this->load->model('TeamModel');
        $team = new TeamModel();
        
        $teamdata['teamid'] = $obj['teamid'];
        $teamdata['name'] = $obj['name'];
        $teamdata['coach'] = $obj['coach'];
        $teamdata['teamslug'] = $obj['teamslug'];
        $teamdata['nickcoach'] = $obj['nickcoach'];
        $teamdata['vr'] = $obj['vr'];
        $teamdata['vm'] = $obj['vm']+1;
        $teamdata['lr'] = $obj['lr'];
        $teamdata['lm'] = $obj['lm'];
        
        if($team->update($teamdata)){
            
        }
    }
    
    public function setmonthlose($obj) {
        $this->load->model('TeamModel');
        $team = new TeamModel();
        
        $teamdata['teamid'] = $obj['teamid'];
        $teamdata['name'] = $obj['name'];
        $teamdata['coach'] = $obj['coach'];
        $teamdata['teamslug'] = $obj['teamslug'];
        $teamdata['nickcoach'] = $obj['nickcoach'];
        $teamdata['vr'] = $obj['vr'];
        $teamdata['vm'] = $obj['vm'];
        $teamdata['lr'] = $obj['lr'];
        $teamdata['lm'] = $obj['lm']+1;
        
        if($team->update($teamdata)){
            
        }
    }
    
    public function checkstatus() {
        $this->load->model('StatusModel');
        $status = new StatusModel();
        $json = $this->getstatus();
        
        $laststatus = $status->search();
        
        $lsdata['statusid'] = $laststatus['statusid'];
        $lsdata['currentround'] = $json['rodada_atual'];
        $lsdata['marketstatus'] = $json['status_mercado'];
        
        if($status->update($lsdata)){
            
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
    
    public function signout() {
        
        $url = 'https://login.globo.com/logout';
        
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
        
        $this->session->sess_destroy();
        redirect(base_url());
    }
}