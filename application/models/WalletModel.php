<?php
class WalletModel extends CI_Model{
    protected $idwallet;
    protected $initialvalue;
    protected $currentvalue;
    protected $currentmonth;
    protected $status;
            
    function WalletModel() {
        parent::__construct();
        $this->setIdwallet(null);
        $this->setInitialvalue(null);
        $this->setCurrentvalue(null);
        $this->setCurrentmonth(null);
        $this->setStatus(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('wallet', $data)) {
                return true;
            }
        }
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("idwallet", $data['idwallet']);
            if ($this->db->update('wallet', $data)) {
                return true;
            }
        }
    }
    
    public function show() {
        $this->db->where("status", 1);
        return $this->db->get("wallet")->row_array();
    }
    
    
    function getIdwallet() {
        return $this->idwallet;
    }

    function getInitialvalue() {
        return $this->initialvalue;
    }

    function getCurrentvalue() {
        return $this->currentvalue;
    }

    function getCurrentmonth() {
        return $this->currentmonth;
    }
    
    function getStatus() {
        return $this->status;
    }

    function setIdwallet($idwallet) {
        $this->idwallet = $idwallet;
    }

    function setInitialvalue($initialvalue) {
        $this->initialvalue = $initialvalue;
    }

    function setCurrentvalue($currentvalue) {
        $this->currentvalue = $currentvalue;
    }

    function setCurrentmonth($currentmonth) {
        $this->currentmonth = $currentmonth;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}