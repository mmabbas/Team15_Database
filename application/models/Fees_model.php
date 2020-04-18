<?php
class Fees_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function createFee($feeInfo)
    {
        $this->db->insert('fees', $feeInfo);
        return true;
    }

    public function getFees($userID)
    {
        $query = $this->db->get_where('fees', array('userID' => $userID));
        return $query->result_array();
    }

    public function updateFeeStatus($feeID)
    {
        $this->db->where('feeID', $feeID);
        $this->db->update('fees', array('feeStatus' => "Paid"));
        return true;
    }

    public function updateFeeDate($feeID)
    {
        $this->db->where('feeID', $feeID);
        $this->db->update('fees', array('dateSettled' => date("Y-m-d")));
        return true;
    }

    public function feeNum($userID)
    {
        $this->db->where('userID', $userID);
        $result = $this->db->get('cardholder');
        return $result->row(0)->feeID;
    } 

    public function getOneFee($feeID)
    {
        $query = $this->db->get_where('fees', array('feeID' => $feeID));
        return $query->row();
    }
   
}