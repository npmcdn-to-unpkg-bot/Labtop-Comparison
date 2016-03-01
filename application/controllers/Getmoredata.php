<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Getmoredata extends CI_Controller {
    function Getmoredata()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('laptop_model');
    }
    function addon()
    {
        $var = $this->input->post('start');
        $data = $this->laptop_model->getmoreDB($var);
        echo json_encode($data);
    }
    function getDatabyID()
    {
        $pid = $this->input->post('pid');
        $data = $this->laptop_model->getDBbyID($pid);
        echo json_encode($data);
    }
}
?>