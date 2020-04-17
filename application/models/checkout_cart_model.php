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
   $dayLimit = $this->user_model->getDayLimit($userID);
   $this->db->select('userID');
   $this->db->from('item');
   $this->db->where('itemID', $itemID);

   $updateitem = array(
       'userID' => $userID,
       'checkedOutBy' => $loginID,
       'status' => 'Unavailable',
       'checkoutDate' => date("Y-m-d"),
       'dueDate' => date('Y-m-d', strtotime('+'.$dayLimit.' days')),
       );
   $this->db->update('item', $updateitem);
 }
 function removeUser($itemID){
   $this->db->where('itemID', $itemID);
   $updateitem = array(
       'userID' => NULL,
       'checkedOutBy' => NULL,
       'status' => 'Available',
       'checkoutDate' => NULL,
       'dueDate' => NULL,
       );
   $this->db->update('item', $updateitem);
 }

}
