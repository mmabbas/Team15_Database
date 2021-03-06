<?php
class CheckedOut_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_items($userID = FALSE)
    {
        if ($userID === FALSE) {
            //$this->db->order_by('item.userID', 'ASC');
            $query = $this->db->get('item');
            return $query->result_array();
        }
        //$this->db->order_by('item.itemID', 'DESC');
        $query = $this->db->get_where('item', array('userID' => $userID));
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
        $query = $this->db->get_where('loans', array('userID' => $userID));
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

    public function getCheckOutFrequencyByDay()
    {
        $week = array(
            '1' => 0,
            '2' => 0,
            '3' => 0,
            '4' => 0,
            '5' => 0,
            '6' => 0,
            '7' => 0,
        );
        $query = $this->db->query('SELECT DAYOFWEEK(`checkOutDate`) as dayOfWeek, COUNT(*) as count FROM loans GROUP BY `checkOutDate` ORDER BY dayofWeek ASC');
        $result = $query->result_array();
        //print_r($result);
        //print_r("<br><br><br>");
        for ($i = 0; $i < count($result); $i++) {
            $count = $result[$i]['count'];
            //print_r("<br><br><br>");
            //print_r($result[$i]['count']);
            $week[$result[$i]['dayOfWeek']] = $count;
        }
        return $week;
    }

    public function mostCheckedOutItem()
    {
        $query = $this->db->query('SELECT `itemName`, COUNT(`itemName`) AS `value_occurrence` FROM `loans` GROUP BY `itemName` ORDER BY `value_occurrence` DESC LIMIT 1');
        return $query->row();
    }

    public function mostActiveUsers()
    {
        $query = $this->db->query('SELECT `userID`, COUNT(*) as count FROM loans GROUP BY `userID` ORDER BY userID ASC');
        $result = $query->result_array();
        return $result;
    }

    public function getCheckOutAmount()
    {
        $query = $this->db->query('SELECT COUNT(*) as amount FROM loans WHERE `checkOutDate` BETWEEN (CURRENT_DATE() - INTERVAL 1 MONTH) AND CURRENT_DATE()');
        return $query->row(0)->amount;
    }

    public function mostPopularTitles()
    {
        $returnArray = array();
        $query = $this->db->query('SELECT `itemName`, COUNT(*) as count FROM loans WHERE `checkOutDate` BETWEEN (CURRENT_DATE() - INTERVAL 1 MONTH) AND CURRENT_DATE() GROUP BY `itemName` ORDER BY count DESC LIMIT 5');
        $result = $query->result_array();

        for ($i = 0; $i < count($result); $i++) {
            $itemName = $result[$i]['itemName'];
            $count = $result[$i]['count'];
            $returnArray[$i]['itemName'] = $itemName;
            $returnArray[$i]['count'] = $count;
        }
        
        if(count($result) < 5)
        {
            for ($i = count($result); $i < 5; $i++) {
                $itemName = 'None';
                $count = 0;
                $returnArray[$i]['itemName'] = $itemName;
                $returnArray[$i]['count'] = $count;
            }
        }

        return $returnArray;
    }
}
