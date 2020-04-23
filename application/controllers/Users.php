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
        //$this->form_validation->set_rules('username', 'Username', 'required');
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
            $this->session->set_flashdata('user_updated', 'You are now registered and can log in');
            redirect('users/login');
        }
    }

    public function updateUser()
    {
        $this->form_validation->set_rules('firstName', 'First Name', 'required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'required');
        //$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/editProfile');
            $this->load->view('templates/footer');
        } else {
            //Encrypt Password
            $enc_password = md5($this->input->post('password'));
            $this->user_model->update_user($enc_password);

            $user_id = $this->session->userdata['user_id'];
            $user_type = $this->session->userdata['user_type'];
            $this->db->where('userID', $user_id);
            $result = $this->db->get('cardholder');
            $user_data = array(
                'user_id' => $user_id,
                'username' => $result->row()->loginID,
                'logged_in' => true,
                'userType' => "User",
                'first_name' => $result->row()->firstName,
                'last_name' => $result->row()->lastName,
                'age' => $result->row()->age,
                'email' => $result->row()->email,
                'dayLimit' => $result->row()->dayLimit,
                'user_type' => $user_type,
            );
            $this->session->set_userdata($user_data);

            $this->session->set_flashdata('user_updated', 'Your User Profile has been updated');
            redirect('users/userprofile');
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
            $this->db->where('userID', $user_id);
            $result = $this->db->get('cardholder');
            if ($user_id) {
                
                if ($result->row()->userType == 1) {
                    $user_type = "Student";
                } else {
                    $user_type = "Faculty";
                }
                //Create Session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                    'userType' => "User",
                    'first_name' => $result->row()->firstName,
                    'last_name' => $result->row()->lastName,
                    'age' => $result->row()->age,
                    'dayLimit' => $result->row()->dayLimit,
                    'email' => $result->row()->email,
                    'user_type' => $user_type,
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

    //Log User Out
    public function logout()
    {
        //Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('pages/view');
    }

    public function newDash()
    {
        $data['firstName'] = $this->user_model->getName($this->session->userdata['user_id']);
        $data['activeCheckOuts'] = $this->checkedOut_model->activeCheckout($this->session->userdata['user_id']);
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        $data['latestReservations'] = $this->reservation_model->getUserReservations($this->session->userdata['user_id']);
        $data['dayLimit'] = $this->user_model->getDayLimit($this->session->userdata['user_id']);
        $data['bookLimit'] = $this->user_model->getBookLimit($this->session->userdata['user_id']);
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
        if ($this->user_model->check_username_exists($username)) {
            return true;
        } else {
            $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
            $this->session->set_flashdata('not_signed_in', 'That username is taken. Please choose a different one');
            redirect("users/register");
            return false;
        }
    }

    public function check_email_exists($email)
    {
        //$this->session->set_flashdata('not_signed_in', 'That email is taken. Please choose a different one');
        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
            redirect("users/register");
            return false;
        }
    }

    public function checkedOut()
    {
        $data['title'] = 'Checked Out';
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        $data['items'] = $this->checkedOut_model->get_items($this->session->userdata['user_id']);
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

    public function confirmCancelation($itemID)
    {
        $data['title'] = 'Confirm Cancelation';
        $data['item'] = $this->fetch_item->getItem($itemID);
        //print_r($data['item']);
        $this->load->view('templates/header');
        $this->load->view('users/confirmCancelation', $data);
        $this->load->view('templates/footer');
    }

    public function createReservation($itemID)
    {
        //update item status to reserved
        $this->fetch_item->reserveItem($itemID);
        //update total available
        $item = $this->fetch_item->getItem($itemID);
        $this->inventory_model->decrementTotalAvailable($item->isbn);
        $this->inventory_model->incrementTotalReserved($item->isbn);
        //add to reservation table
        $reservationInfo = array(
            'userID' => $this->session->userdata['user_id'],
            'itemID' => $item->itemID,
            'itemName' => $item->title,
            'reservationDate' => date("Y-m-d"),
            'expirationDate' => date('Y-m-d', strtotime('+1 week')),
            #'status' => 'Processing',
        );
        $this->reservation_model->createReservation($reservationInfo);

        $this->session->set_flashdata('user_registered', 'Reservation has been created successfully');
        redirect('users/search');
    }

    public function cancelReservation($itemID)
    {
        //update item status to Available
        $this->fetch_item->unReserveItem($itemID);
        //update total available
        $item = $this->fetch_item->getItem($itemID);
        $this->inventory_model->incrementTotalAvailable($item->isbn);
        $this->inventory_model->decrementTotalReserved($item->isbn);
        //add to reservation table
        $this->reservation_model->deleteReservation($itemID);

        $this->session->set_flashdata('user_registered', 'Reservation has been canceled successfully');
        redirect('users/newDash');
    }
    public function confirmCheckout($itemID)
    {
        $data['title'] = 'Confirm Checkout';
        $data['item'] = $this->fetch_item->getItem($itemID);
        //print_r($data['item']);
        $this->load->view('templates/header');
        $this->load->view('users/checkout_cart_view', $data);
        $this->load->view('templates/footer');
    }
    public function createCheckout($itemID)
    {
        $this->load->model('CheckedOut_model');
        $bookLimit = $this->user_model->getBookLimit($this->session->userdata['user_id']);
        $amountLoaned = $this->user_model->getQuantityCheckedOut($this->session->userdata['user_id']);
        if ($amountLoaned >= $bookLimit) {
            $this->session->set_flashdata('no_reservations', 'You cannot exceed your book limit. Return some books and try again');
            redirect('users/newDash');
        }
        $item = $this->fetch_item->getItem($itemID);
        $isbn = $item->isbn;

        if ($item->status == "Reserved") {
            $this->inventory_model->decrementTotalReserved($isbn);
            $this->reservation_model->checkOutReservation($item->itemID);
        } else {
            $this->inventory_model->decrementTotalAvailable($isbn);
        }
        //update item status
        $this->checkout_cart_model->checkOutItem($itemID);
        //update total available
        $this->inventory_model->incrementTotalCheckedout($isbn);
        //add to loan table
        $dayLimit = $this->session->userdata['dayLimit'];
        $loanInfo = array(
            'userID' => $this->session->userdata['user_id'],
            'itemID' => $item->itemID,
            'itemName' => $item->title,
            'checkOutDate' => date("Y-m-d"),
            'dueDate' => date('Y-m-d', strtotime('+' . $dayLimit . ' days')),
            'status' => 'Checked Out',
        );
        $this->checkedOut_model->createLoan($loanInfo);
        //augment qunatityCheckedOut
        $this->user_model->increaseQuantityCheckedOut($this->session->userdata['user_id']);
        //add to item table
        $this->session->set_flashdata('user_registered', 'Checkout was successful');
        if ($item->status == "Reserved") {
            redirect('users/newDash');
        } else {
            redirect('users/search');
        }
    }
    public function confirmReturn($itemID)
    {
        $data['title'] = 'Confirm Return';
        $data['item'] = $this->fetch_item->getItem($itemID);
        //print_r($data['item']);
        $this->load->view('templates/header');
        $this->load->view('users/confirmReturnBook', $data);
        $this->load->view('templates/footer');
    }
    public function returnBook($itemID)
    {
        //remove user from item
        $this->checkout_cart_model->removeUser($itemID);
        //update total available
        $item = $this->fetch_item->getItem($itemID);
        $this->inventory_model->incrementTotalAvailable($item->isbn);
        $this->inventory_model->decrementTotalCheckedout($item->isbn);
        $this->user_model->decreaseQuantityCheckedOut($this->session->userdata['user_id']);
        $this->checkedOut_model->updateLoanStatus($itemID);
        //return to dash
        redirect('users/newDash');
    }

    public function getHistory()
    {
        $data['title'] = 'Reservation History';
        $data['reservations'] = $this->reservation_model->getHistory($this->session->userdata['user_id']);
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        if (empty($data['reservations'])) {
            $this->session->set_flashdata('no_reservations', 'You don\'t have any reservations');
            redirect('users/newDash');
        }
        $this->load->view('templates/header');
        $this->load->view('users/reservationHistory', $data);
        $this->load->view('templates/footer');
    }
    public function checkoutHistory()
    {
        $data['title'] = 'Checkout History';
        $data['loans'] = $this->checkedOut_model->checkoutHistory($this->session->userdata['user_id']);
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        if (empty($data['loans'])) {
            $this->session->set_flashdata('no_reservations', 'You don\'t have any checkout history');
            redirect('users/newDash');
        }
        $this->load->view('templates/header');
        $this->load->view('users/checkoutHistory', $data);
        $this->load->view('templates/footer');
    }

    public function userprofile()
    {
        $data['title'] = 'User Profile';
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        $data['reservations'] = $this->reservation_model->getUserReservations($this->session->userdata['user_id']);
        $this->load->view('templates/header');
        $this->load->view('users/userprofile', $data);
        $this->load->view('templates/footer');
    }

    public function editProfile()
    {
        $data['title'] = 'Edit Profile';
        $this->load->view('templates/header');
        $this->load->view('users/editProfile');
        $this->load->view('templates/footer');
    }

    public function userFees()
    {
        $data['title'] = 'User Fees';
        $data['numOfCheckOuts'] = $this->checkedOut_model->activeCheckoutNum($this->session->userdata['user_id']);
        $data['reserveNum'] = $this->reservation_model->getActiveUserCount($this->session->userdata['user_id']);
        $data['reservations'] = $this->reservation_model->getUserReservations($this->session->userdata['user_id']);
        $data['feeTotal'] = $this->fees_model->getTotalFees($this->session->userdata['user_id']);
        $data['feeCount'] = $this->fees_model->getFeeCount($this->session->userdata['user_id']);
        // $data['titleNames'] = $this->fetch_item->getItem($itemID)
        $data['feesNums'] = $this->fees_model->getFees($this->session->userdata['user_id']);
        $this->load->view('templates/header');
        $this->load->view('users/userFees', $data);
        $this->load->view('templates/footer');
    }

    public function updateFee($feeID)
    {
        //update fee status to paid
        $this->fees_model->updateFeeStatus($feeID);
        //update date user paid
        //$this->fees_model->updateFeeDate($feeID);
        $amount = $this->fees_model->feeNum($this->session->userdata['user_id']);
        $feeAmount = $this->fees_model->getOneFee($feeID);
        $amount = $amount - $feeAmount->feeAmount;
        $this->fees_model->updateCardholderFee($amount, $this->session->userdata['user_id']);
        $this->fees_model->updateFeeDate($feeID);

        $this->session->set_flashdata('user_registered', 'Fee has been paid successfully');
        redirect('users/newDash');
    }

    public function confirmPayment($feeID)
    {
        $data['title'] = 'Confirm Payment';
        $data['feesArray'] = $this->fees_model->getOneFee($feeID);
        //print_r($data['item']);
        $this->load->view('templates/header');
        $this->load->view('users/confirmPayment', $data);
        $this->load->view('templates/footer');
    }
}
