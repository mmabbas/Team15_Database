<?php
class Reservation_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_reservations()
    {
            $this->db->order_by('reservations.userID', 'ASC');
            //$this->db->join('item', 'item.itemID = reservations.itemID');
            $query = $this->db->get('reservations');
            return $query->result_array();
    }

    public function getUserReservations($userID)
    {
            $this->db->order_by('reservations.userID', 'ASC');
            $query = $this->db->get_where('reservations', array('userID' => $userID));
            return $query->result_array();
    }

    public function getActiveUserCount($userID)
    {
        $this->db->order_by('reservations.reservationID', 'DESC');
        $query = $this->db->get_where('reservations', array('userID' => $userID));
        return $query->num_rows();
    }

    public function getActiveCount()
    {
        $query = $this->db->get_where('reservations', array('status' => "Processing"));
        //$query = $this->db->query('SELECT * FROM reservations');
        return $query->num_rows();
    }

    public function getLatest()
    {
        $this->db->select('*');
        $this->db->order_by('reservations.reservationID', 'DESC');
        $this->db->from('reservations');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result_array();
    }
}
