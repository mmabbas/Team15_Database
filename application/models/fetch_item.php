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
  function assignImage($itemType){
    if($itemType == 1){
    return '<img class="item-img" src="'.base_url().'assets/images/book.png" />'; //<img src="'.base_url().'upload/'."file_name".'" />
  }elseif($itemType == 2){
    return '<img class="item-img" src="'.base_url().'assets/images/audio-book.png" />';
  }elseif($itemType == 3){
    return '<img class="item-img" src="'.base_url().'assets/images/film.png" />';
  }else{
    return '<img class="item-img" src="'.base_url().'assets/images/error.png" />';
  }

  }
  function get_data($query, $searchBy, $searchType){
    $this->db->select("*");
    $this->db->from("item");
    if($searchType != 0){
    $this->db->where('type', $searchType);
    }
    //$this->db->where('userID is NULL', NULL, FALSE);
    //Look up user input as $query from item.title, item.author and item.distributor
    if($query != ''){
      if($searchBy == "title"){
      $this->db->like('title', $query);
    } elseif ($searchBy == "author") {
      $this->db->like('author', $query);
    } elseif ($searchBy == "distributor") {
      $this->db->like('distributor', $query);
    }
  }
    $this->db->order_by('title', 'ASC');
    return $this->db->get()->result();
  }

  public function getAll()
    {
        $this->db->select('itemID, userID, title, isbn, genre, author, status');
        $this->db->from('item');
        $this->db->order_by('itemID', 'ASC');
        return $this->db->get()->result();
    }

  public function getItem($itemID)
  {
    $query = $this->db->get_where('item', array('itemID' => $itemID));
    return $query->row();
  }

  public function reserveItem($itemID)
  {
    $this->db->where('itemID', $itemID);
    $this->db->update('item', array('status' => "Reserved"));
    return true;
  }

  public function unReserveItem($itemID)
  {
    $this->db->where('itemID', $itemID);
    $this->db->update('item', array('status' => "Available"));
    return true;
  }
}
