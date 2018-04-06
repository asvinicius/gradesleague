<?php
class RoundsModel extends CI_Model{
    protected $roundsid;
    protected $begin;
    protected $month;
    protected $end;
    
    function RoundsModel() {
        parent::__construct();
        $this->setRoundsid(null);
        $this->setBegin(null);
        $this->setMonth(null);
        $this->setEnd(null);
    }
   
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('rounds', $data)) {
                return true;
            }
        }
    }
        
    public function search($roundsid) {
        $this->db->where("roundsid", $roundsid);
        return $this->db->get("rounds")->row_array();
    }
    
    function getRoundsid() {
        return $this->roundsid;
    }

    function getMonth() {
        return $this->month;
    }

    function getBegin() {
        return $this->begin;
    }

    function getEnd() {
        return $this->end;
    }

    function setRoundsid($roundsid) {
        $this->roundsid = $roundsid;
    }

    function setMonth($month) {
        $this->month = $month;
    }

    function setBegin($begin) {
        $this->begin = $begin;
    }

    function setEnd($end) {
        $this->end = $end;
    }


}