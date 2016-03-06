<?php

class Laptop_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function getData(){
        $query = $this->db->query("select * from DB limit 0,30")->result();
        return $query;
    }
    public function getmoreDB($start, $query, $graphic_filter){
        $query = $this->db->query("select * from DB where (graphic_spec like '%$graphic_filter%' and model like '%$query%') limit $start, 30")->result();
        return $query;
    }
    public function getDBbyID($pid){
        $query = $this->db->query("select * from DB where pid = '$pid'")->result();
        return $query;
    }
}
?>