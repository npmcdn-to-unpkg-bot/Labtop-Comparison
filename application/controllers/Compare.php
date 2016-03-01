<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Compare extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('laptop_model');
    }
    function index(){
        
    }
    function id($pid1, $pid2){
        $data1 = $this->laptop_model->getDBbyID($pid1);
        $data2 = $this->laptop_model->getDBbyID($pid2);
        $this->load->view('head');
        $this->load->view('compare', array('data1'=>$data1, 'data2'=>$data2));
        $this->load->view('footer');
    }
}
?>