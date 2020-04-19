<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "secret", "team15dbms");
$columns = array('loanID', 'userID', 'itemID', 'itemName', 'checkOutDate', 'dueDate', 'overDue', 'status');

$query = "SELECT * FROM loans WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'checkOutDate BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if($_POST["checkoutBox"] == "Checked Out")
{
  $query .= '
   (status LIKE "%'.$_POST["checkoutBox"].'%")
  ';
}
elseif(isset($_POST["search"]["value"]))
{
 $query .= '
  (loanID LIKE "%'.$_POST["search"]["value"].'%"
  OR userID LIKE "%'.$_POST["search"]["value"].'%"
  OR itemID LIKE "%'.$_POST["search"]["value"].'%"
  OR itemName LIKE "%'.$_POST["search"]["value"].'%"
  OR checkOutDate LIKE "%'.$_POST["search"]["value"].'%"
  OR dueDate LIKE "%'.$_POST["search"]["value"].'%"
  OR overDue LIKE "%'.$_POST["search"]["value"].'%"
  OR status LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'
 ';
}
else
{
 $query .= 'ORDER BY loanID DESC ';
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
 $sub_array[] = $row["loanID"];
 $sub_array[] = $row["userID"];
 $sub_array[] = $row["itemID"];
 $sub_array[] = $row["itemName"];
 $sub_array[] = $row["checkOutDate"];
 $sub_array[] = $row["dueDate"];
 $sub_array[] = $row["overDue"];
 $sub_array[] = $row["status"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM loans";
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
