<?php
    class Reservation_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

        public function get_reservations($userID = FALSE)
        {
            if($userID === FALSE)
            {
                $this->db->order_by('reservations.userID', 'ASC');
                //$this->db->join('item', 'item.itemID = reservations.itemID');
                $query = $this->db->get('reservations');
                return $query->result_array();
            }
            $this->db->order_by('reservations.reservationID', 'DESC');
            $query = $this->db->get_where('reservations', array('userID' => $userID));
            return $query->result_array();
        }
    }