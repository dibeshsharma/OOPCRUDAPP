<?php 
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */
namespace Console;
session_start();

use Exception;
use Console\Model\CrudItems;
use Console\Model\Locations;
use Console\Model\Categories;
require('Model\CrudItems.php');
require('Model\Locations.php');
require('Model\Categories.php');

$crudItems = new CrudItems();
$crudItems->set_mode("delete");
$mode = $crudItems->get_mode();

$locations = new Locations();
$categories = new Categories();

include('phpScript.php');
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