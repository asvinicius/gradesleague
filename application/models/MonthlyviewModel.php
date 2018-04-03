<?php
class MonthlyviewModel extends CI_Model{
    protected $mvid;
    protected $month;
    protected $winner;
    protected $loser;
    
    function MonthlyviewModel() {
        parent::__construct();
        $this->setMvid(null);
        $this->setMonth(null);
        $this->setWinner(null);
        $this->setLoser(null);
    }
   
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('monthlyview', $data)) {
                return true;
            }
        }
    }
    
    public function listing($avid) {
        $this->db->where("month", $avid);
        return $this->db->get("monthlyview")->result();
    }
    
    function getMvid() {
        return $this->mvid;
    }

    function getMonth() {
        return $this->month;
    }

    function getWinner() {
        return $this->winner;
    }

    function getLoser() {
        return $this->loser;
    }

    function setMvid($mvid) {
        $this->mvid = $mvid;
    }

    function setMonth($month) {
        $this->month = $month;
    }

    function setWinner($winner) {
        $this->winner = $winner;
    }

    function setLoser($loser) {
        $this->loser = $loser;
    }


}