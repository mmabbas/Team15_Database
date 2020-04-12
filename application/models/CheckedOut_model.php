<?php
class CheckedOut_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_items($userID = FALSE)
    {
        if($userID === FALSE)
        {
            //$this->db->order_by('item.userID', 'ASC');
            $query = $this->db->get('item');
            return $query->result_array();
        }
        //$this->db->order_by('item.itemID', 'DESC');
        $query = $this->db->get_where('item', array('userID' =>$userID));
        return $query->result_array();
    }

    public function getActiveCount()
    {
        $query = $this->db->get_where('item', array('status' => "Checked Out"));
        return $query->num_rows();
    }

    public function getAll()
    {
        $this->db->order_by('item.itemID', 'ASC');
        $query = $this->db->get_where('item', array('status' => "Checked Out"));
        return $query->result_array();
    }

    public function activeCheckout($userID)
    {
        $query = $this->db->get_where('item', array('userID' => $userID));
        return $query->result_array();
    }

    public function activeCheckoutNum($userID)
    {
        $query = $this->db->get_where('item', array('userID' => $userID));
        return $query->num_rows();
    }
}
?>