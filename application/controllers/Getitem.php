<?php
class Getitem extends CI_Controller{
  function index(){
    $this->load->view('searchBar');
  }

  function getData(){
    $output = '';
    $query = '';
    $this->load->model('fetch_item');
    if($this->input->post('query')){
      $query = $this->input->post('query');
    }
    $data = $this->fetch_item->get_data($query);
    if(!empty($data)){
    foreach($data as $row){
      $output .=
      "<div class='items-box'>
              <h3>".$row->title."</h3>
              <p>".$row->author."</p>
              <p>".$row->year."</p>
              <p>".$row->genre."</p>
            </div>";
    }
  }else {
    $output .= "No results";
  }
  echo $output;
  }
}
?>
