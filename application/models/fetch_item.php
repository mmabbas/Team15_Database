<?php
class Fetch_item extends CI_Model {
  function get_item(){
    //select * from item
    $query = $this->db->get("item");
    return $query;
  }

  function get_db(){
    $db = get_instance()->db->conn_id;
    return $db;
  }

  function get_data($query){
    $this->db->select("*");
    $this->db->from("item");
    if($query != ''){
      $this->db->like('title', $query);
      $this->db->or_like('author', $query);
    }
    //$this->db->order_by('itemID', 'DESC');
    return $this->db->get()->result();
  }
}
?>
