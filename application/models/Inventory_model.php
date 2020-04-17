<?php
class Inventory_model extends CI_Model
{

    public function decrementTotalAvailable($isbn)
    {
        $this->db->set('totalAvailable', 'totalAvailable-1', FALSE);
        $this->db->where('isbn', $isbn);
        $this->db->update('inventory');
    }

    public function incrementTotalReserved($isbn)
    {
        $this->db->set('totalReserved', 'totalReserved+1', FALSE);
        $this->db->where('isbn', $isbn);
        $this->db->update('inventory');
    }

    public function decrementTotalReserved($isbn)
    {
        $this->db->set('totalReserved', 'totalReserved-1', FALSE);
        $this->db->where('isbn', $isbn);
        $this->db->update('inventory');
    }

    public function incrementTotalAvailable($isbn)
    {
        $this->db->set('totalAvailable', 'totalAvailable+1', FALSE);
        $this->db->where('isbn', $isbn);
        $this->db->update('inventory');
    }
    public function incrementTotalCheckedout($isbn)
    {
        $this->db->set('totalCheckedout', 'totalCheckedout+1', FALSE);
        $this->db->where('isbn', $isbn);
        $this->db->update('inventory');
    }

    public function getTotalAvailable($itemInfo)
    {
        $query = $this->db->get_where('inventory', array('isbn' => $itemInfo->isbn));
        return $query->row();
    }
    public function decrementTotalCheckedout($isbn)
    {
      $this->db->set('totalCheckedout', 'totalCheckedout-1', FALSE);
      $this->db->where('isbn', $isbn);
      $this->db->update('inventory');
    }
}
