<?php
class Adminportal extends CI_Controller
{
    public function addItem()
    {
        $data['title'] = 'Add Item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('genre', 'Genre', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('distributor', 'Distributor', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('adminfuncs/addItem', $data);
            $this->load->view('templates/footer');
        } else {
            
            $this->user_model->add_item();

            //set message
            $this->session->set_flashdata('item_added', 'Item has been added to the Library');
            redirect('users/adminDashboard');
            //redirect('adminDashboard');
        }
        // $data['title'] = 'Add Item';
        // $this->load->view('templates/header');
        // $this->load->view('adminfuncs/addItem');
        // $this->load->view('templates/footer');
    }

    public function issueItem()
    {
        $data['title'] = 'Issue Item';
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/issueItem');
        $this->load->view('templates/footer');
    }

    public function adminReservations()
    {
        $data['title'] = 'View All Reservations';
        $data['reservations'] = $this->reservation_model->get_reservations();
        //print_r(($data['reservations']));
        if(empty($data['reservations']))
        {
            $this->session->set_flashdata('no_reservations', 'There are no reservations at the moment');
            redirect('users/dashboard');
        }
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/adminReservations', $data);
        $this->load->view('templates/footer');
    }
}