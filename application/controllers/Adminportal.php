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
            redirect('adminportal/viewtitles');
            //redirect('adminDashboard');
        }
        // $data['title'] = 'Add Item';
        // $this->load->view('templates/header');
        // $this->load->view('adminfuncs/addItem');
        // $this->load->view('templates/footer');
    }

    public function editItem($itemID)
    {
        $data['title'] = 'Edit Title';
        $data['item'] = $this->fetch_item->getItem($itemID);

            $this->load->view('templates/header');
            $this->load->view('adminfuncs/editItem', $data);
            $this->load->view('templates/footer');

    }

    public function update()
        {
            $this->admin_model->updateItem();
            $this->admin_model->update_item_invID();
            //set message
            $this->session->set_flashdata('post_updated', 'Item has been updated');
            redirect('adminportal/viewTitles');
        }

    public function issueItem()
    {
        $data['title'] = 'Issue Item';
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/issueItem');
        $this->load->view('templates/footer');
    }

    public function adminReports()
    {
        $data['title'] = 'View All Reports';
        $data['allReservations'] = $this->reservation_model->getActiveReservations();
        $data['reservations'] = $this->reservation_model->getActiveCount();
        $data['checkOuts'] = $this->checkedOut_model->getActiveCount();
        $data['totalTitles'] = $this->fetch_item->getCount();
        $data['userCount'] = $this->user_model->getCount();
        //print_r(($data['reservations']));
        /*if (empty($data['reservations'])) {
            $this->session->set_flashdata('no_reservations', 'There are no active reservations at the moment');
            redirect('users/adminDashboard');
        }*/
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/adminReports', $data);
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

	public function reportCheckout()
	{
        $data['checkOutInfo'] = $this->checkedOut_model->getCheckOutFrequencyByDay();
        $data['mostCheckedOut'] = $this->checkedOut_model->mostCheckedOutItem();
        $data['mostActive'] = $this->checkedOut_model->mostActiveUsers();
        //print_r($data['mostActive']);
        //print_r("<br>");
        //print_r($checkOutCount[0]['count']);


		$this->load->view('templates/header');
        $this->load->view('adminfuncs/reportCheckout', $data);
        $this->load->view('templates/footer');

    }

	public function fetchReportCheckoutData()
	{
		$this->load->view('adminfuncs/fetchCheckout');
	}

	public function reportReservation()
    {
        $data['reservationInfo'] = $this->reservation_model->getReservationFrequencyByDay();
        $data['mostReserved'] = $this->reservation_model->mostReservedItem();
        //$data['mostActive'] = $this->reservation_model->mostActiveUsers();
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/reportReservation', $data);
        $this->load->view('templates/footer');
    }

	public function fetchReportReservationData()
    {
        $this->load->view('adminfuncs/fetchReservation');
    }

	public function reportFee()
	{
        $data['income'] = $this->fees_model->getPaidAmount()*5;
        $data['owe'] = $this->fees_model->getUnpaidAmount()*5;
        $data['topFiveUsers'] = $this->fees_model->getTopFiveUsers();
        //print_r($data['topFiveUsers']);
        //print_r('<br><br>');
        //print_r($data['topFiveUsers'][0]['userID']);
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/reportFee', $data);
        $this->load->view('templates/footer');
		
    }

	public function fetchReportFeeData()
	{
		$this->load->view('adminfuncs/fetchFee');
	}

    public function confirmDeletion($itemID)
    {
        $data['title'] = 'Confirm Deletion';
        $data['item'] = $this->fetch_item->getItem($itemID);
        //print_r($data['item']);
        $this->load->view('templates/header');
        $this->load->view('adminfuncs/confirmDeletion', $data);
        $this->load->view('templates/footer');
    }

    public function deleteItem($itemID)
    {
        //update item status to Deleted
        $this->fetch_item->deleteItem($itemID);
        //update total available
        $item = $this->fetch_item->getItem($itemID);
        $this->inventory_model->decrementTotalAvailable($item->isbn);

        $this->session->set_flashdata('user_registered', 'Item has been deleted successfully');
        redirect('adminportal/viewTitles');
    }

}
