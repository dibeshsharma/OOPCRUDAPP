<?php
namespace Console;
header("Content-Type:application/json");

use Console\Database\DB;
require('Database\DB.php');


$db = new DB();
foreach( $db->getResults( "SELECT * FROM ds_crud_items" ) as $result )
{
  $item_id = $result['item_id'];
  $item_price = $result['item_price'];
  
  echo "item_id: $item_id" . "<br />" . "item_price: $item_price" . "<br /><br />";
}

// $data = "";

// $messages = $dbHandler->result;

// $replyMessage = array(
//     'messages'  => $messages,
//     'data' => $data
// );

// $replyMessageJson = json_encode($replyMessage);

// echo $replyMessageJson;
?>


