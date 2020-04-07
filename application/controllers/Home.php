<?php
class Home extends CI_Controller
{
    PUBLIC FUNCTION __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('home');
    }
}

?>