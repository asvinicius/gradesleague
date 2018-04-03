<?php
class AnnualviewModel extends CI_Model{
    protected $avid;
    protected $description;
    protected $rounds;
    protected $winner;
    protected $loser;
    
    function AnnualviewModel() {
        parent::__construct();
        $this->setAvid(null);
        $this->setDescription(null);
        $this->setRounds(null);
        $this->setWinner(null);
        $this->setLoser(null);
    }
   
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('annualview', $data)) {
                return true;
            }
        }
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("avid", $data['avid']);
            if ($this->db->update('annualview', $data)) {
                return true;
            }
        }
    }
    
    public function listing() {
        return $this->db->get("annualview")->result();
    }
    
    public function search($avid) {
        $this->db->where("avid", $avid);
        return $this->db->get("annualview")->row_array();
    }
    
    function getAvid() {
        return $this->avid;
    }

    function getDescription() {
        return $this->description;
    }

    function getRounds() {
        return $this->rounds;
    }

    function getWinner() {
        return $this->winner;
    }

    function getLoser() {
        return $this->loser;
    }

    function setAvid($avid) {
        $this->avid = $avid;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setRounds($rounds) {
        $this->rounds = $rounds;
    }

    function setWinner($winner) {
        $this->winner = $winner;
    }

    function setLoser($loser) {
        $this->loser = $loser;
    }


}