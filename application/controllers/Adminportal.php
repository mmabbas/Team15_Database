<?php
class Adminportal extends CI_Controller
{
    public function addItem()
    {
        $data['title'] = 'Add Item';
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/addItem');
        $this->load->view('templates/footer');
    }

    public function issueItem()
    {
        $data['title'] = 'Issue Item';
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/issueItem');
        $this->load->view('templates/footer');
    }
}