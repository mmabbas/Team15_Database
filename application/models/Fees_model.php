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
    public function getPaidAmount()
    {
        $query = $this->db->get_where('fees', array('feeStatus' => 'Paid'));
        return $query->num_rows();
    }
    public function getUnpaidAmount()
    {
        $query = $this->db->get_where('fees', array('feeStatus' => 'Unpaid'));
        return $query->num_rows();
    }

    public function getTopFiveUsers()
    {
        $returnArray = array();

        $query = $this->db->query('SELECT `userID`, COUNT(*) as count FROM fees GROUP BY `userID` ORDER BY count DESC LIMIT 5');
        $result = $query->result_array();
        //print_r($result);
        //print_r("<br><br><br>");
        for ($i = 0; $i < count($result); $i++) {
            $userID = $result[$i]['userID'];
            $count = $result[$i]['count'];
            //print_r("<br><br><br>");
            //print_r($result[$i]['count']);
            $userName = $this->user_model->getName($userID);
            $returnArray[$i]['userID'] = ''.$userName.' (User ID #'.$userID.')';
            $returnArray[$i]['count'] = $count;
        }

        for ($i = count($result); $i < 5; $i++) {
            $userName = 'None';
            $count = 0;
            //print_r("<br><br><br>");
            //print_r($result[$i]['count']);
            $returnArray[$i]['userID'] = $userName;
            $returnArray[$i]['count'] = $count;
        }

        return $returnArray;
    }
}
