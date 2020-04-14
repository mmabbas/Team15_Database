<?php
class Getitem extends CI_Controller{
  function index(){
    $this->load->view('search');
  }

  function getData(){
    $status = '';
    $button = '';
    $output = '';
    $query = '';
    $searchBy = '';
    $searchType = '';
    $onClick = "";
    $this->load->model('fetch_item');
    if($this->input->post('search')){
      $query = $this->input->post('search');
      $searchBy = $this->input->post('title');
      $searchType = $this->input->post('type');
    }
    $data = $this->fetch_item->get_data($query, $searchBy, $searchType);
    if(!empty($data)){
    foreach($data as $row){
    $amount = $this->fetch_item->checkAmount($row->inventoryID);
    if(intval($amount->totalAvailable) > 0){
      $button = 'Check Out';
      $status = 'Available';
      $onClick = "window.location.href='checkout_cart_view'";
    } else {
      $button = 'Reserve';
      $status = 'Unavailable';
      $onClick = "window.location.href='reserveStatus'";
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
      <div class='input-group-append'>
              <button id='item-btn' class='btn btn-Danger' type='button' onClick=$onClick>".$button."</button>
      </div>
      </div>";
    }
  }else {
    $output .= "No results";
  }
  echo $output;
  }
}
?>
