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
                'distributor' => $this->input->post('distributor'),
            );

            //insert user
            return $this->db->insert('item', $itemData);
        }

        public function updateItem()
        {
            $itemData = array(
                'title' => $this->input->post('title'),
                'type' => $this->input->post('type'),
                'status' => 'Available',
                'genre' => $this->input->post('genre'),
                'year' => $this->input->post('year'),
                'author' => $this->input->post('author'),
                'distributor' => $this->input->post('distributor'),
            );

            //update item
            $this->db->where('itemID', $this->input->post('id'));
            return $this->db->update('item', $itemData);
        }

        public function update_post()
        {
            $slug = url_title($this->input->post('title'));

            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id')
            );

            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('posts', $data);
        }

        public function admin_login($username, $password)
        {
            //validate
            $this->db->where('loginID', $username);
            $this->db->where('password', $password);

            $result = $this->db->get('employee');

            if ($result->num_rows() == 1) {
                return $result->row(0)->employeeID;
            } else {
                return false;
            }
        }

        public function update_item_invID()
        {
            $itemisbn = $this->input->post('isbn');
            $this->db->select('inventoryID');
            $this->db->from('inventory');
            $this->db->where('isbn', $itemisbn);
            // $invID = $this->db->get();
            //$query = $this->db->get_where('inventory', array('isbn' => $itemisbn));
            $query = $this->db->get()->row('inventoryID');
            // var_dump($invID);
            // $invID = $this->db->query('SELECT inventoryID FROM inventory WHERE inventory.isbn = $itemisbn');
            $updateitem = array(
                'inventoryID' => $query
                );
            $this->db->where('isbn', $itemisbn);
            return $this->db->update('item', $updateitem);
        }
    }
?>