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
        //$endResult = $this->db->update('cardholder', array('fines' => $result->fines));
        return $result->row(0)->fines;
    } 

    public function getOneFee($feeID)
    {
        $query = $this->db->get_where('fees', array('feeID' => $feeID));
        return $query->row();
    }

    public function updateCardholderFee($amount, $userID)
    {
        $this->db->set('fines', $amount);
        $this->db->where('userID', $userID);
        $this->db->update('cardholder');
        return true;
    }

    public function getTotalFees($userID)
    {
        $query = $this->db->get_where('cardholder', array('userID' => $userID));
        return $query->row()->fines;
    }

    public function getFeeCount($userID)
    {
        $query = $this->db->get_where('fees', array('userID' => $userID, 'feeStatus' => 'Unpaid'));
        return $query->num_rows();
    }
   
}