<?php
namespace Console;

use Exception;
use Console\Model\CrudItems;

require('Model\CrudItems.php');
require('templateView.php');

//$item_id = $date_added = $item_name = $item_category = $item_location = $item_price = $available = "";
$crudItems = new CrudItems();
$templateView = new templateView();

$errors = [];
$response = [];

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    
$basename = basename($actual_link);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // item_id
    // set the item id to show old value in the form
    if (empty($_POST["item_id"])) {
        $errors[] = "Item Id Field is Required";        
    } else {
        $item_id = sanitizeData($_POST["item_id"]);
        $crudItems->set_item_id($item_id);
    }

    // date_added
    if (empty($_POST["date_added"])) {
        $errors[] = "Date Added Field is Required";        
    } else {
        $date_added = sanitizeData($_POST["date_added"]);
        $crudItems->set_date_added($date_added);
    }

    // item_name
    if (empty($_POST["item_name"])) {
        $errors[] = "Item Name Field is Required";        
    } else {
        $item_name = sanitizeData($_POST["item_name"]);
        $crudItems->set_item_name($item_name);
    }

    // item_category
    if (empty($_POST["item_category"])) {
        $errors[] = "Item Category Field is Required";        
    } else {
        $item_category = sanitizeData($_POST["item_category"]);
        $crudItems->set_item_category($item_category);
    }

    // item_location
    if (empty($_POST["item_location"])) {
        $errors[] = "Item Location Field is Required";        
    } else {
        $item_location = sanitizeData($_POST["item_location"]);
        $crudItems->set_item_location($item_location);
    }

    // item_price
    if (empty($_POST["item_price"])) {
        $errors[] = "Item Price Field is Required";        
    } else {
        $item_price = sanitizeData($_POST["item_price"]);
        $crudItems->set_item_price($item_price);
    }

    // available
    if (empty($_POST["available"])) {
        $errors[] = "Available Field is Required";        
    } else {
        $available = sanitizeData($_POST["available"]);
        $crudItems->set_available($available);
    }

    if(!empty($errors)){    
        $errors = $errors; 
        $messages = [];   
    } else {    
        $postData = array(
            "item_id" => $item_id,
            "date_added" => $date_added,
            "item_name" => $item_name,
            "item_category" => $item_category,
            "item_location" => $item_location,
            "item_price" => $item_price,
            "available" => $available
        ); 

        // Get the server side response
        $response = submitForm($postData);

        var_dump($response);

        //Reset the form
        $crudItems = new CrudItems();
    }
}

function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function submitForm($postData)
{
    
    $url = 'http://localhost/local/Console/process.php'; 
    try{
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);						
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);

      curl_setopt($ch, CURLOPT_POST, TRUE);

      $payload = json_encode(array("crudItems" => $postData));

      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
      ));

      $response = curl_exec ($ch);
      if ($response === false) {
                throw new Exception(curl_error($ch), curl_errno($ch)); 
            }			
    }catch (Exception $e) {
            $error_message = $e->getMessage();
    }
    curl_close($ch); 
    return $response;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php include('views/layouts/app.layout.php'); ?>
</body>
</html>


