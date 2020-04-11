<?php
class Getitem extends CI_Controller{
  function index(){
    $this->load->view('searchBar');
  }

  function getData(){
    $status = '';
    $button = '';
    $output = '';
    $query = '';
    $this->load->model('fetch_item');
    if($this->input->post('query')){
      $query = $this->input->post('query');
    }
    $data = $this->fetch_item->get_data($query);
    if(!empty($data)){
    foreach($data as $row){
    $amount = $this->fetch_item->checkAmount($row->inventoryID);
    if(intval($amount->totalAvailable) > 0){
      $button = 'Check Out';
      $status = 'Available';
    } else {
      $button = 'Reserve';
      $status = 'Unavailable';
    }
      $output .=
      "<div class='items-box'>
              <h3>".$row->title."</h3>
              <p>".$row->author."</p>
              <p>".$row->year."</p>
              <p>".$row->genre."</p>
              <p>".$row->inventoryID."</p>
              <p>".$status."</p>
              <p>Total Available: ".$amount->totalAvailable."</p>
      <div class='input-group-append'>
              <button class='btn btn-warning' type='button'>".$button."</button>
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
