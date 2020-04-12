<?php
class Fetch_item extends CI_Model {
  function get_item(){
    //select * from item
    $query = $this->db->get("item");
    return $query;
  }

  public function getCount()
    {
        $query = $this->db->query('SELECT * FROM item');
        return $query->num_rows();
    }

  function checkAmount($query){ //get total items available
    $this->db->select('*');
    $this->db->from("inventory");
    //WHERE inventory.iventoryID = item.inventoryID
    $this->db->where('inventoryID', $query);
    return $this->db->get()->row();
  }

  function get_db(){
    $db = get_instance()->db->conn_id;
    return $db;
  }

  function get_data($query){
    $this->db->select("*");
    $this->db->from("item");
    //Look up user input as $query from item.title, item.author and item.distributor
    if($query != ''){
      $this->db->like('title', $query);
      $this->db->or_like('author', $query);
      $this->db->or_like('distributor', $query);
    }
    //$this->db->order_by('itemID', 'DESC');
    return $this->db->get()->result();
  }

  public function getAll()
    {
        $this->db->select('itemID, userID, title, isbn, genre, author, status');
        $this->db->from('item');
        $this->db->order_by('itemID', 'ASC');
        return $this->db->get()->result();
    }
}
?>
