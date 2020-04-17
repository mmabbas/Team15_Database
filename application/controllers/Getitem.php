<?php
class Getitem extends CI_Controller{
  function index(){
    $this->load->view('search');
  }

  function getData(){
    $status = '';
    $tempID = '';
    $output = '';
    $query = '';
    $searchBy = '';
    $searchType = '';
    $temp2 = '';
    $this->load->model('fetch_item');
    if($this->input->post('search')){
      $query = $this->input->post('search');
      $searchBy = $this->input->post('title');
      $searchType = $this->input->post('type');
    }
    $data = $this->fetch_item->get_data($query, $searchBy, $searchType);
    if(!empty($data)){
    foreach($data as $row){
    $temp1 = $row->isbn;
    if($temp1 != $temp2){
      $amount = $this->fetch_item->checkAmount($row->inventoryID);
      if(intval($amount->totalAvailable) > 0){
        $status = 'Available';
      } else {
        $status = 'Unavailable';
      }
        $itemImg = $this->fetch_item->assignImage($row->type);
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
    }
      $temp2 = $row->isbn;
    }
  }else {
    $output .= "No results";
  }
  echo $output;
  }
}
