<?php
class Getitem extends CI_Controller{
  function index(){
    //funtion testing
    $this->load->view('search');
  }

  function getData(){
    $output = '';
    $query = '';
    $temp2 = '';
    //user input filters
    if($this->input->post('search')){
      $query = $this->input->post('search');
      $searchBy = $this->input->post('title');
      $searchType = $this->input->post('type');
    }
    //grab items
    $data = $this->fetch_item->get_data($query, $searchBy, $searchType);
    //display items if there is one
    if(!empty($data)){
    foreach($data as $row){
    $temp1 = $row->isbn;
    $amount = $this->fetch_item->checkAmount($row->inventoryID);
    //check if there are and free item copy available
    if(intval($amount->totalAvailable) > 0){
      $status = 'Available';
    } else {
      $status = 'Unavailable';
    }
    //assign a image base on the item type **THIS WILL NEED TO BE CHANGE BEFORE WE SUBMIT** (check fetch_item model to see why)
    $itemImg = $this->fetch_item->assignImage($row->type);
    //display only one of the same item at a time
    if($temp1 != $temp2){
      //check to see if a user is set to the item
      $username = $row->checkedOutBy;
      if($username == NULL or $status == 'Unavailable'){
        $isNull = false;
      }else{
        $isNull = true;
      }
      if($status == 'Available' and $username == NULL){
        $output .=
      "<div class='items-box'>
              $itemImg
              <h3 class='item-title'>".$row->title."</h3>
              <p class='item-author'>".$row->author."</p>
              <p class='year'>".$row->year."</p>
              <p class='item-status'>".$status."</p>
              <p class='total-available'>Total Available: ".$amount->totalAvailable."</p>
      <div class='input-group-append' id='item-btn'>
              <button id='checkout-btn' class='btn btn-Danger' type='button' onClick=window.location.href='confirmCheckout/$row->itemID'>Check Out</button>
              <button id='reserve-btn' class='btn btn-Danger' type='button' onClick=window.location.href='confirmReservation/$row->itemID'>Reserve</button>
      </div>
      </div>";
    }elseif($status == 'Unavailable'){
      $output .=
    "<div class='items-box'>
            $itemImg
            <h3 class='item-title'>".$row->title."</h3>
            <p class='item-author'>".$row->author."</p>
            <p class='year'>".$row->year."</p>
            <p class='item-status'>".$status."</p>
            <p class='total-available'>Total Available: ".$amount->totalAvailable."</p>
    </div>";
    }
  }
  //cache the book isbn so that a copy wont be displayed
  if($isNull == false)
  {
      $temp2 = $row->isbn;
  }
  }
  }else {
    //display "No Results" if there is no item found
    $output .= "No results";
  }
  //display the item in the page
  echo $output;
  }
}
