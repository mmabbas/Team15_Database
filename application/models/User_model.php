<?php
class User_model extends CI_Model
{
    public function register($enc_password)
    {
        $usertype = $this->input->post('usertype');
        if($usertype == 1)
        {
            $daylimit = 3;
            $booklimit = 3;
        }
        else
        {
            $daylimit = 5;
            $booklimit = 5;
        }
        //login data array
        $loginData = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'email' => $this->input->post('email'),
            'loginID' => $this->input->post('username'),
            'password' => $enc_password,
            'age' => $this->input->post('age'),
            'userType' => $this->input->post('usertype'),
            'dayLimit' => $daylimit,
            'bookLimit' => $booklimit
        );

        //insert user
        return $this->db->insert('cardholder', $loginData);
    }

    //user log in
    public function login($username, $password)
    {
        //validate
        $this->db->where('loginID', $username);
        $this->db->where('password', $password);

        $result = $this->db->get('cardholder');

        if ($result->num_rows() == 1) {
            return $result->row(0)->userID;
        } else {
            return false;
        }
    }

    //check username exists
    public function check_username_exists($username)
    {
        $query = $this->db->get_where('cardholder', array('loginID' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($username)
    {
        $query = $this->db->get_where('cardholder', array('email' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function getCount()
    {
        $query = $this->db->query('SELECT * FROM cardholder');
        return $query->num_rows();
    }

    public function getAll()
    {
        $this->db->select('userID, firstName, lastName, email, loginID');
        $this->db->from('cardholder');
        $this->db->order_by('userID', 'ASC');
        return $this->db->get()->result();
    }

    public function getName($userID)
    {
        $this->db->where('userID', $userID);
        $result = $this->db->get('cardholder');
        return $result->row(0)->firstName;
    }
    
}
