<?php

$username='root';
$password='';
$connect=new PDO('mysql:host=localhost;dbname=car-rental', $username, $password);

$query='';
$output=array();
$search = $_POST["search"]["value"];
$query .='SELECT * FROM branches WHERE branch_name LIKE "%'.$search.'%" OR address LIKE "%'.$search.'%" OR contact_number LIKE "%'.$search.'%"';

if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement=$connect->prepare($query);
$statement->execute();
$result=$statement->fetchAll();
$data=array();
$filtered_rows=$statement->rowCount();


foreach($result as $row) {
    $sub_array=array();
    $sub_array[]=$row["branch_name"];
    $sub_array[]=$row["address"];
    $sub_array[]=$row["contact_number"];
    $data[]=$sub_array;
}

function get_total_all_records($connect) {
    $statement=$connect->prepare("SELECT * FROM branches");
    $statement->execute();
    $result=$statement->fetchAll();
    return $statement->rowCount();
}

$output=array("draw"=> intval($_POST["draw"]),
"recordsTotal"=> $filtered_rows,
"recordsFiltered"=> get_total_all_records($connect),
"data"=> $data);
echo json_encode($output);

?>