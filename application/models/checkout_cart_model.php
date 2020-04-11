<?php
class checkout_cart_model extends CI_Model
{
 function fetch_item()
 {
  $query = $this->db->get("item");
  return $query->result();
 }
 
 function fetch_invent()
 {
	 $query = $this->db->get("inventory");
	 return $query->result();
 }
}
?>