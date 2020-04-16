<?php
class Adminportal extends CI_Controller
{
    public function adminLogin()
    {
        $data['title'] = 'Sign In';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/adminLogin', $data);
            $this->load->view('templates/footer');
        } else {
            //get username
            $username = $this->input->post('username');
            //get and encrypt password
            $password = $this->input->post('password');
            //$password = md5($this->input->post('password'));

            //Login user
            $user_id = $this->admin_model->admin_login($username, $password);

            if ($user_id) {
                //Create Session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                    'userType' => "Admin",
                );

                $this->session->set_userdata($user_data);

                //set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('adminportal/adminDashboard');
            } else {
                //set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('adminportal/adminLogin');
            }
        }
    }

    public function adminDashboard()
    {
        if (!$this->session->userdata['logged_in']) {
            $this->session->set_flashdata('not_signed_in', 'You are not signed in. Please sign in');
            redirect('adminportal/adminlogin');
        }
        $data['title'] = 'Dashboard';


        $data['reservations'] = $this->reservation_model->getActiveCount();
        $data['checkOuts'] = $this->checkedOut_model->getActiveCount();
        $data['totalTitles'] = $this->fetch_item->getCount();
        $data['userCount'] = $this->user_model->getCount();
        $data['latestReservations'] = $this->reservation_model->getLatest();

        $this->load->view('templates/header');
        $this->load->view('adminfuncs/adminDash', $data);
        $this->load->view('templates/footer');
    }

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

            $this->admin_model->add_item();
            $this->admin_model->update_item_invID();
            
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
            $this->session->set_flashdata('no_reservations', 'There are no active reservations at the moment');
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
