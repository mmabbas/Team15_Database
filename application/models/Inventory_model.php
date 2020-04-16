<?php
class Inventory_model extends CI_Model
{

    public function decrementTotalAvailable($isbn)
    {
        $this->db->set('totalAvailable', 'totalAvailable-1', FALSE);
        $this->db->where('isbn', $isbn);
        $this->db->update('inventory');
    }

    public function incrementTotalAvailable($isbn)
    {
        $this->db->set('totalAvailable', 'totalAvailable+1', FALSE);
        $this->db->where('isbn', $isbn);
        $this->db->update('inventory');
    }
}
