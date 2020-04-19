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
        $query = $this->db->get_where('item', array('status' => "Unavailable"));
        return $query->num_rows();
    }

    public function getAll()
    {
        $this->db->order_by('item.itemID', 'ASC');
        $query = $this->db->get_where('item', array('status' => "Unavailable"));
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
    public function createLoan($reservationInfo)
    {
        $this->db->insert('loans', $reservationInfo);
        return true;
    }
    public function checkoutHistory($userID)
    {
        $this->db->order_by('loans.loanID', 'DESC');
        $query = $this->db->get_where('loans', array('userID'=> $userID));
        return $query->result_array();
    }
    public function getActiveCheckout($userID)
    {
        $this->db->order_by('loans.loanID', 'DESC');
        $query = $this->db->get_where('loans', array('userID' => $userID, 'status' => "Checked Out"));
        return $query->num_rows();
    }
    public function updateLoanStatus($itemID)
    {
        $this->db->where('itemID', $itemID);
        $this->db->update('loans', array('status' => "Returned"));
        return true;
    }
}
?>
