<?php
    class User_model extends CI_Model
    {
        public function register($enc_password)
        {
            //login data array
            $loginData = array(
                'firstName' => $this->input->post('firstName'),
                'lastName' => $this->input->post('lastName'),
                'email' => $this->input->post('email'),
                'loginID' => $this->input->post('username'),
                'password' => $enc_password,
                'age' => $this->input->post('age'),
                'userType' =>$this->input->post('usertype'),
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

            if($result->num_rows() == 1)
            {
                return $result->row(0)->userID;
            }
            else{
                return false;
            }

        }
        public function admin_login($username, $password)
        {
            //validate
            $this->db->where('loginID', $username);
            $this->db->where('password', $password);

            $result = $this->db->get('employee');

            if($result->num_rows() == 1)
            {
                return $result->row(0)->employeeID;
            }
            else{
                return false;
            }

        }

        //check username exists
        public function check_username_exists($username)
        {
            $query = $this->db->get_where('cardholder', array('loginID' => $username));
            if(empty($query->row_array()))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function check_email_exists($username)
        {
            $query = $this->db->get_where('cardholder', array('email' => $username));
            if(empty($query->row_array()))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    
        public function add_item()
            {
                //login data array
                $itemData = array(
                    'title' => $this->input->post('title'),
                    'type' => $this->input->post('type'),
                    'isbn' => $this->input->post('isbn'),
                    'status' => 'Available',
                    'genre' => $this->input->post('genre'),
                    'year' => $this->input->post('year'),
                    'author' => $this->input->post('author'),
                    'distributor' =>$this->input->post('distributor'),
                );

                //insert user
                return $this->db->insert('item', $itemData);
            }
    }
?>