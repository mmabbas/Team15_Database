<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class checkout_cart extends CI_Controller 
{
 
 function content()
 {
  $this->load->model("checkout_cart_model");
  $data["item"] = $this->checkout_cart_model->fetch_all();
  $this->load->view("checkout_cart_view", $data);
 }

//Add item to checkout cart.
 function add()
 {
  $this->load->library("cart");
  $data = array
  (
   "id"  => $_POST["itemID"],
   "name"  => $_POST["title"],
   "quantity" => $_POST[""]
  );
  
  $this->cart->insert($data);  
  echo $this->view();
 }

 function load()
 {
  echo $this->view();
 }

//Remove from checkout cart.
 function remove()
 {
  $this->load->library("cart");
  $row_id = $_POST["row_id"];
  $data = array(
   'rowid'  => $row_id,
   'qty'  => 0
  );
  $this->cart->update($data);
  echo $this->view();
 }

//Clear entire checkout cart.
 function clear()
 {
  $this->load->library("cart");
  $this->cart->destroy();
  echo $this->view();
 }
 
 //
 function view()
 {
  $this->load->library("cart");
  $output = '';
  $output .= '
  <h3>checkout Cart</h3><br />
  <div class="table-responsive">
   <div align="right">
    <button type="button" id="clear_cart" class="btn btn-warning">Clear Cart</button>
   </div>
   <br />
   <table class="table table-bordered">
    <tr>
     <th width="40%">Name</th>
     <th width="15%">Quantity</th>
 
     <th width="15%">Total</th>
     <th width="15%">Action</th>
    </tr>

  ';
  $count = 0;
  
  foreach($this->cart->contents() as $items)
  {
   $count++;
   $output .= '
   <tr> 
    <td>'.$items["name"].'</td>
    <td>'.$items["qty"].'</td>
    <td><button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="'.$items["rowid"].'">Remove</button></td>
   </tr>
   ';
  }
  $output .= '
   <tr>
    <td colspan="4" align="right">Total</td>
    <td>'.$this->cart->total().'</td>
   </tr>
  </table>

  </div>
  ';

//If zero items, display "Cart is Empty"
  if($count == 0)
  {
   $output = '<h3 align="center">Cart is Empty</h3>';
  }
  return $output;
 }
}
