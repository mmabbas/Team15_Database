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
 function checkOutItem($itemID){
   $userID = $this->session->userdata['user_id'];
   $loginID = $this->session->userdata['username'];
   $this->db->select('userID');
   $this->db->from('item');
   $this->db->where('itemID', $itemID);
   $updateitem = array(
       'userID' => $userID,
       'checkedOutBy' => $loginID,
       'status' => 'Unavailable'
       );
   $this->db->update('item', $updateitem);
 }

}
?>
