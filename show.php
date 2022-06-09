<?php 
namespace Console;
session_start();

use Exception;
use Console\Model\CrudItems;

require('Model\CrudItems.php');

//$item_id = $date_added = $item_name = $item_category = $item_location = $item_price = $available = "";
$crudItems = new CrudItems();

include('urlScript.php');
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