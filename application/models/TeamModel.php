<?php
class TeamModel extends CI_Model{
    protected $teamid;
    protected $name;
    protected $coach;
    protected $teamslug;
    protected $nickcoach;
    protected $vr;
    protected $lr;
    protected $vm;
    protected $lm;
    
    function TeamModel() {
        parent::__construct();
        $this->setTeamid(null);
        $this->setName(null);
        $this->setCoach(null);
        $this->setTeamslug(null);
        $this->setNickcoach(null);
        $this->setVr(null);
        $this->setLr(null);
        $this->setVm(null);
        $this->setLm(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('team', $data)) {
                return true;
            }
        }
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("teamid", $data['teamid']);
            if ($this->db->update('team', $data)) {
                return true;
            }
        }
    }
    
    public function delete($teamid) {
        if ($teamid != null) {
            $this->db->where("teamid", $teamid);
            if ($this->db->delete("team")) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("vm", "desc");
        $this->db->order_by("vr", "desc");
        $this->db->order_by("lm", "asc");
        $this->db->order_by("lr", "asc");
        $this->db->order_by("nickcoach", "asc");
        return $this->db->get("team")->result();
    }
    
    public function search($teamid) {
        $this->db->where("teamid", $teamid);
        return $this->db->get("team")->row_array();
    }
    
    function getTeamid() {
        return $this->teamid;
    }

    function getName() {
        return $this->name;
    }

    function getCoach() {
        return $this->coach;
    }

    function getTeamslug() {
        return $this->teamslug;
    }

    function getNickcoach() {
        return $this->nickcoach;
    }

    function getVr() {
        return $this->vr;
    }

    function getLr() {
        return $this->lr;
    }

    function getVm() {
        return $this->vm;
    }

    function getLm() {
        return $this->lm;
    }

    function setTeamid($teamid) {
        $this->teamid = $teamid;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCoach($coach) {
        $this->coach = $coach;
    }

    function setTeamslug($teamslug) {
        $this->teamslug = $teamslug;
    }

    function setNickcoach($nickcoach) {
        $this->nickcoach = $nickcoach;
    }

    function setVr($vr) {
        $this->vr = $vr;
    }

    function setLr($lr) {
        $this->lr = $lr;
    }

    function setVm($vm) {
        $this->vm = $vm;
    }

    function setLm($lm) {
        $this->lm = $lm;
    }


}