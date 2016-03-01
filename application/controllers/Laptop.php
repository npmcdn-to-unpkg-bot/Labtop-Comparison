<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laptop extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('laptop_model');
    }
    function index(){
        $data = $this->laptop_model->getData();
        $this->load->view('head');
        $this->load->view('main', array('data'=>$data));
        $this->load->view('footer');
    }
}
?>