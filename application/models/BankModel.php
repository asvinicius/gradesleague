<?php
class BankModel extends CI_Model{
    protected $bankid;
    protected $team;
    protected $balance;
            
    function BankModel() {
        parent::__construct();
        $this->setBankid(null);
        $this->setTeam(null);
        $this->setBalance(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('bank', $data)) {
                return true;
            }
        }
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("bankid", $data['bankid']);
            if ($this->db->update('bank', $data)) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->join('team', 'team.teamid=team', 'inner');
        $this->db->order_by("team.nickcoach", "asc");
        return $this->db->get("bank")->result();
    }
    
    public function search($bankid) {
        $this->db->where("bankid", $bankid);
        return $this->db->get("bank")->row_array();
    }
    
    function getBankid() {
        return $this->bankid;
    }

    function getTeam() {
        return $this->team;
    }

    function getBalance() {
        return $this->balance;
    }

    function setBankid($bankid) {
        $this->bankid = $bankid;
    }

    function setTeam($team) {
        $this->team = $team;
    }

    function setBalance($balance) {
        $this->balance = $balance;
    }


}