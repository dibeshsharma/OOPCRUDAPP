<?php
namespace Console;
header("Content-Type:application/json");

use Console\Model\CrudItems;
require('Model\CrudItems.php');

$item_id = $date_added = $item_name = $item_category = $item_location = $item_price = $available = "";
$errors = [];

$data = json_decode(file_get_contents('php://input'), true);

$item_id = $data['crudItems']['item_id'];
$date_added = $data['crudItems']['date_added'];
$item_name = $data['crudItems']['item_name'];
$item_category = $data['crudItems']['item_category'];
$item_location = $data['crudItems']['item_location'];
$item_price = $data['crudItems']['item_price'];
$available = $data['crudItems']['available'];

if($available == 'yes'){
    $available = 1;
} else{
    $available = 0;
}

$crudItems = new CrudItems($item_id, $date_added, $item_name, $item_category, $item_location, $item_price, $available);
$crudItems->save();
$messages = $crudItems->result;

$replyMessage = array(
    'messages'  => $messages,
    'data' => $data
);

$replyMessageJson = json_encode($replyMessage);

echo $replyMessageJson;
?>


