<?php
/*class Laptop_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function gets(){
        return $this->db->query("SELECT * FROM DB LIMIT 0,100")->result();
        
    }
}*/

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
}
?>