<?php
class Users extends CI_Controller
{
    //register user
    public function register()
    {
        $data['title'] = 'Sign Up';

        $this->form_validation->set_rules('firstName', 'First Name', 'required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
        $this->form_validation->set_rules('usertype', 'User Type', 'required');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');
        } else {
            //Encrypt Password
            $enc_password = md5($this->input->post('password'));
            $this->user_model->register($enc_password);
            //$password = $this->input->post('password');
            //$this->user_model->register('password');

            //set message
            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            redirect('home');
        }
    }

    //login user
    public function login()
    {
        $data['title'] = 'Sign In';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {
            //get username
            $username = $this->input->post('username');
            //get and encrypt password
            //$password = $this->input->post('password');
            $password = md5($this->input->post('password'));

            //Login user
            $user_id = $this->user_model->login($username, $password);

            if ($user_id) {
                //Create Session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                    'userType' => "User",
                );

                $this->session->set_userdata($user_data);

                //set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('users/newDash');
            } else {
                //set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('users/login');
            }
        }
    }

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
            $user_id = $this->user_model->admin_login($username, $password);

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
                redirect('users/adminDashboard');
            } else {
                //set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('users/adminLogin');
            }
        }
    }

    //Log User Out
    public function logout()
    {
        //Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('users/login');
    }

    public function adminDashboard()
    {
        if (!$this->session->userdata['logged_in']) {
            $this->session->set_flashdata('not_signed_in', 'You are not signed in. Please sign in');
            redirect('users/login');
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

    public function newDash()
    {
        $data['firstName'] = $this->user_model->getName($this->session->userdata['user_id']);
        $data['activeCheckOuts'] = $this->checkedOut_model->activeCheckout($this->session->userdata['user_id']);
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        $data['latestReservations'] = $this->reservation_model->getUserReservations($this->session->userdata['user_id']);
        $this->load->view('templates/header');
        $this->load->view('users/newDash', $data);
        $this->load->view('templates/footer');
    }

    public function dashboard()
    {
        if (!$this->session->userdata['logged_in']) {
            $this->session->set_flashdata('not_signed_in', 'You are not signed in. Please sign in');
            redirect('users/login');
        }
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header');
        $this->load->view('users/dashboard');
        $this->load->view('templates/footer');
    }

    public function oldAdminDashboard()
    {
        if (!$this->session->userdata['logged_in']) {
            $this->session->set_flashdata('not_signed_in', 'You are not signed in. Please sign in');
            redirect('users/adminLogin');
        }
        $data['title'] = 'Admin Dashboard';

        $this->load->view('templates/header');
        $this->load->view('users/adminDashboard');
        $this->load->view('templates/footer');
    }

    //Check if username exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');

        if ($this->user_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');

        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkedOut()
    {
        $data['title'] = 'Checked Out';
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        $data['items'] = $this->checkedOut_model->get_items($this->session->userdata['user_id']);
        if (empty($data['items'])) {
            $this->session->set_flashdata('none_checkedOut', 'You don\'t have any items checked out');
            redirect('users/dashboard');
        }
        $this->load->view('templates/header');
        $this->load->view('users/checkedOut', $data);
        $this->load->view('templates/footer');
    }

    public function search()
    {
        $data['title'] = 'Search Bar';
        $this->load->view('templates/header');
        $this->load->view('users/search');
        $this->load->view('templates/footer');
    }

    public function reserveStatus()
    {
        $data['title'] = 'Reservation Status';
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        $data['reservations'] = $this->reservation_model->getUserReservations($this->session->userdata['user_id']);
        if (empty($data['reservations'])) {
            $this->session->set_flashdata('no_reservations', 'You don\'t have any reservations');
            redirect('users/newDash');
        }
        $this->load->view('templates/header');
        $this->load->view('users/reserveStatus', $data);
        $this->load->view('templates/footer');
    }

    public function checkout_cart()
    {
        $this->load->model('checkout_cart_model');
    }

    public function confirmReservation($itemID)
    {
        $data['title'] = 'Confirm Reservation';
        $data['item'] = $this->fetch_item->getItem($itemID);
        //print_r($data['item']);
        $this->load->view('templates/header');
        $this->load->view('users/confirmReservation', $data);
        $this->load->view('templates/footer');
    }

    public function createReservation($itemID)
    {
        //update item status to reserved
        $this->fetch_item->reserveItem($itemID);
        //update total available
        $item = $this->fetch_item->getItem($itemID);
        $this->inventory_model->decrementTotalAvailable($item->isbn);
        //add to reservation table
        $reservationInfo = array(
            'userID' => $this->session->userdata['user_id'],
            'itemID' => $item->itemID,
            'itemName' => $item->title,
            'reservationDate' => date("Y-m-d"),
            'expirationDate' => date('Y-m-d', strtotime('+1 week')),
        );
        $this->reservation_model->createReservation($reservationInfo);

        $this->session->set_flashdata('user_registered', 'Reservation has been created successfully');
        redirect('users/newDash');

    }
}
