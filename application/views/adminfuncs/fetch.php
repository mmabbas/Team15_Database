<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "secret", "team15dbms");
$columns = array('itemID', 'title', 'author', 'genre', 'distributor', 'dateAdded');

$query = "SELECT * FROM item WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'dateAdded BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (itemID LIKE "%'.$_POST["search"]["value"].'%" 
  OR title LIKE "%'.$_POST["search"]["value"].'%" 
  OR author LIKE "%'.$_POST["search"]["value"].'%" 
  OR genre LIKE "%'.$_POST["search"]["value"].'%"
  OR distributor LIKE "%'.$_POST["search"]["value"].'%" 
  OR dateAdded LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY itemID DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["itemID"];
 $sub_array[] = $row["title"];
 $sub_array[] = $row["author"];
 $sub_array[] = $row["genre"];
 $sub_array[] = $row["distributor"];
 $sub_array[] = $row["dateAdded"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM item";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>