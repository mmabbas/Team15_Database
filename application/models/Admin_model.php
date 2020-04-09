<?php
    class Admin_model extends CI_Model
    {
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