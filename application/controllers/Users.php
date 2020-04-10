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
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);

                //set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('users/dashboard');
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
                    'logged_in' => true
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

    public function dashboard()
    {
        if(!$this->session->userdata['logged_in'])
        {
            $this->session->set_flashdata('not_signed_in', 'You are not signed in. Please sign in');
            redirect('users/login');
        }
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header');
        $this->load->view('users/dashboard');
        $this->load->view('templates/footer');
    }

    public function adminDashboard()
    {
        if(!$this->session->userdata['logged_in'])
        {
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
        //$data['Checked Out'] = $this
        $data['items'] = $this->checkedOut_model->get_items($this->session->userdata['user_id']);
        if(empty($data['items']))
        {
            $this->session->set_flashdata('none_checkedOut', 'You don\'t have any items checked out');
            redirect('users/dashboard');
        }
        $this->load->view('templates/header');
        $this->load->view('users/checkedOut', $data);
        $this->load->view('templates/footer');
    }

    public function searchBar()
    {
        $data['title'] = 'Search Bar';
        $this->load->view('templates/header');
        $this->load->view('users/searchBar');
        $this->load->view('templates/footer');
    }

    public function reserveStatus()
    {
        $data['title'] = 'Reservation Status';
        //$data['reservations'] = $this->reservation_model->get_reservations();
        $data['reservations'] = $this->reservation_model->get_reservations($this->session->userdata['user_id']);
        //print_r(($data['reservations']));
        if(empty($data['reservations']))
        {
            $this->session->set_flashdata('no_reservations', 'You don\'t have any reservations');
            redirect('users/dashboard');
        }
        $this->load->view('templates/header');
        $this->load->view('users/reserveStatus', $data);
        $this->load->view('templates/footer');
    }
	
	public function checkout_cart_view()
	{
		$this->load->model('checkout_cart_model');
		$data['item'] = $this->checkout_cart_model->fetch_all();
		$this->load->view('templates/header');
		$this->load->view('users\checkout_cart_view', $data);
		$this->load->view('templates/footer');
	}
}
