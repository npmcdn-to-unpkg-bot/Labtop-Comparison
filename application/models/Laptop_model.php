<?php

class Laptop_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getData(){
        $query = $this->db->query("select * from DB limit 0,30")->result();
        return $query;
    }
    public function getmoreDB($start){
        $query = $this->db->query("select * from DB limit $start, 30")->result();
        return $query;
    }
    public function getDBbyID($pid){
        $query = $this->db->query("select * from DB where pid = '$pid'")->result();
        return $query;
    }
}
?>