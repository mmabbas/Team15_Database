<?php
class Pages extends CI_Controller
{
    public function view($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }
        $data['title'] = ucfirst($page);

        if ($page != 'home') {
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        }
    }

    public function search()
    {
        $this->load->view('templates/header');
        $this->load->view('users/searchBar');
        $this->load->view('templates/footer');
    }
}
