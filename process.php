<?php
namespace Console;
header("Content-Type:application/json");

use Console\Model\CrudItems;
require('Model\CrudItems.php');

$item_id = $date_added = $item_name = $item_category = $item_location = $item_price = $available = "";
$errors = [];

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['crudItems']['id'];
$item_id = $data['crudItems']['item_id'];
$date_added = $data['crudItems']['date_added'];
$item_name = $data['crudItems']['item_name'];
$item_category = $data['crudItems']['item_category'];
$item_location = $data['crudItems']['item_location'];
$item_price = $data['crudItems']['item_price'];
$available = $data['crudItems']['available'];
$mode = $data['crudItems']['mode'];

if($available == 'yes'){
    $available = 1;
} else{
    $available = 0;
}

$crudItems = new CrudItems($id, $item_id, $date_added, $item_name, $item_category, $item_location, $item_price, $available, $mode);
$crudItems->save($id);
$results = $crudItems->results;
echo json_encode($results);
?>


