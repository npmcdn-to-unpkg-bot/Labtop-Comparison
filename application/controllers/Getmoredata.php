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
        $start = $this->input->post('start');
        $query = $this->input->post('query');
        $size_filter = $this->input->post('size_filter');
        $graphic_filter = $this->input->post('graphic_filter');
        $data = $this->laptop_model->getmoreDB($start, $query,$size_filter, $graphic_filter);
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