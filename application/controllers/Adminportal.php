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
            $this->user_model->update_item_invID();
            
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
        $data['allReservations'] = $this->reservation_model->get_reservations();
        $data['reservations'] = $this->reservation_model->getActiveCount();
        $data['checkOuts'] = $this->checkedOut_model->getActiveCount();
        $data['totalTitles'] = $this->fetch_item->getCount();
        $data['userCount'] = $this->user_model->getCount();
        //print_r(($data['reservations']));
        if (empty($data['reservations'])) {
            $this->session->set_flashdata('no_reservations', 'There are no reservations at the moment');
            redirect('users/adminDashboard');
        }
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/adminReservations', $data);
        $this->load->view('templates/footer');
    }

    public function viewUsers()
    {
        $data['reservations'] = $this->reservation_model->getActiveCount();
        $data['checkOuts'] = $this->checkedOut_model->getActiveCount();
        $data['totalTitles'] = $this->fetch_item->getCount();
        $data['userCount'] = $this->user_model->getCount();
        $data['userInfo'] = $this->user_model->getAll();
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/userView', $data);
        $this->load->view('templates/footer');
    }

    public function viewTitles()
    {
        $data['reservations'] = $this->reservation_model->getActiveCount();
        $data['checkOuts'] = $this->checkedOut_model->getActiveCount();
        $data['totalTitles'] = $this->fetch_item->getCount();
        $data['userCount'] = $this->user_model->getCount();
        $data['allTitles'] = $this->fetch_item->getAll();
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/viewTitles', $data);
        $this->load->view('templates/footer');
    }

    public function viewCheckOuts()
    {
        $data['reservations'] = $this->reservation_model->getActiveCount();
        $data['checkOuts'] = $this->checkedOut_model->getActiveCount();
        $data['totalTitles'] = $this->fetch_item->getCount();
        $data['userCount'] = $this->user_model->getCount();
        $data['checkOutInfo'] = $this->checkedOut_model->getAll();
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/viewCheckOuts', $data);
        $this->load->view('templates/footer');
    }

    public function reportTest()
    {
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/reportTest');
        $this->load->view('templates/footer');
    }

    public function fetchReportData()
    {
        $this->load->view('adminfuncs/fetch');
    }
}
