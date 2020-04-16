<?php
class Reservation_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function createReservation($reservationInfo)
    {
        $this->db->insert('reservations', $reservationInfo);
        return true;
    }

    public function deleteReservation($itemID)
    {
        $this->db->where('itemID', $itemID);
        $this->db->update('reservations', array('status' => "Canceled"));
        return true;
    }

    public function checkOutReservation($itemID)
    {
        $array = array('status' => "Reserved", 'itemID' => $itemID);
        $this->db->where($array);
        $this->db->update('reservations', array('status' => "Picked Up"));
        return true;
    }


    public function get_reservations()
    {
        $this->db->order_by('reservations.userID', 'ASC');
        //$this->db->join('item', 'item.itemID = reservations.itemID');
        $query = $this->db->get('reservations');
        return $query->result_array();
    }

    public function getUserActiveReservations($userID)
    {
        $this->db->order_by('reservations.userID', 'ASC');
        $query = $this->db->get_where('reservations', array('userID' => $userID, 'status' => "Processing"));
        return $query->result_array();
    }

    public function getUserReservations($userID)
    {
            $this->db->order_by('reservations.userID', 'ASC');
            $query = $this->db->get_where('reservations', array('userID' => $userID, 'status' => "Reserved"));
            return $query->result_array();
    }

    public function getActiveUserCount($userID)
    {
        $this->db->order_by('reservations.reservationID', 'DESC');
        $query = $this->db->get_where('reservations', array('userID' => $userID, 'status' => "Reserved"));
        return $query->num_rows();
    }
    public function getUserCount($userID)
    {
        $this->db->order_by('reservations.reservationID', 'DESC');
        $query = $this->db->get_where('reservations', array('userID' => $userID));
        return $query->num_rows();
    }

    public function getActiveCount()
    {
        $query = $this->db->get_where('reservations', array('status' => "Reserved"));
        //$query = $this->db->query('SELECT * FROM reservations');
        return $query->num_rows();
    }

    public function getTotalCount()
    {
        $query = $this->db->get('reservations');
        return $query->num_rows();
    }

    public function getLatest()
    {
        //$this->db->select('*');
        //$this->db->order_by('reservations.reservationID', 'DESC');
        //$this->db->from('reservations');
        //$this->db->limit('5');
        //$query = $this->db->get();

        $this->db->order_by('reservations.userID', 'ASC');
        $query = $this->db->get_where('reservations', array('status' => "Reserved"));
        return $query->result_array();
    }

    public function getHistory($userID)
    {
        $this->db->order_by('reservations.reservationID', 'DESC');
        $query = $this->db->get_where('reservations', array('userID'=> $userID));
        return $query->result_array();
    }
}
