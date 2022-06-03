<?php 
namespace Console;

use Exception;
use Console\Model\CrudItems;

require('Model\CrudItems.php');
require('templateView.php');

//$item_id = $date_added = $item_name = $item_category = $item_location = $item_price = $available = "";
$crudItems = new CrudItems();

$mode = 'edit';
if(is_int(45)){
    echo "yes";
}else{
    echo "no";
}

if($mode = 'edit'){
    $id = $_GET['id'];
    $result =  $crudItems->get_id($id);
}

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    
$basename = basename($actual_link);
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
    //sidebar
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><?php echo 'King CRUD ITEMS'; ?></h4> 
                <div class="clearfix"></div>  
            </div>    
            <div class="panel-body"> 
                <ul class="nav flex-column">
                    <?php
                        switch ($basename) {
                            case 'index.php':
                                echo "<li class=\"nav-item\">";
                                echo "<a href=$root"."local/Console/index.php"." class=\"nav-link active\"".">Add Items</a>";
                                echo "</li>";
                                echo "<li class=\"nav-item\">";
                                echo "<a href=$root"."local/Console/show.php"." class=\"nav-link\"".">View Items</a>";
                                echo "</li>";
                                break;
                            case 'show.php':
                                echo "<li class=\"nav-item\">";
                                echo "<a href=$root"."local/Console/index.php"." class=\"nav-link\"".">Add Items</a>";
                                echo "</li>";
                                echo "<li class=\"nav-item\">";
                                echo "<a href=$root"."local/Console/show.php"." class=\"nav-link active\"".">View Items</a>";
                                echo "</li>";
                                    break;        
                            default:
                                echo "<li class=\"nav-item\">";
                                echo "<a href=$root"."local/Console/index.php"." class=\"nav-link active\"".">Add Items</a>";
                                echo "</li>";
                                echo "<li class=\"nav-item\">";
                                echo "<a href=$root"."local/Console/show.php"." class=\"nav-link\"".">View Items</a>";
                                echo "</li>";
                                break;
                        }
                    ?>
                </ul>												   
            </div> 
        </div>
    </div>
    //create.php
    <?php




$item_id = $crudItems->get_item_id();
$date_added = $crudItems->get_date_added();
$item_name = $crudItems->get_item_name();
$item_category = $crudItems->get_item_category();
$item_location = $crudItems->get_item_location();
$item_price = $crudItems->get_item_price();
$available = $crudItems->get_available();
?>

//message
<div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Add Items</h4>
            </div>
            <div class="panel-body">
            <?php 
    //Error messages for empty form feilds
    if(!empty($errors)){ 
        echo "<div class='alert alert-danger'>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
        echo "</div>"; 
    }

    // Success, Error messages after Db Opertation
    if(!empty($response)){
        // echo "<li>".$response."</li>";   
        $responseArray = json_decode($response, TRUE);  
        var_dump($responseArray);

        if(isset($responseArray['messages']['status'])){
            if($responseArray['messages']['status'] == 'success'){
                echo "<div class='alert alert-success'>";
                echo "<ul>";         
                    echo "<li>".$responseArray['messages']['message']."</li>"; 
                    echo "<li>".var_dump($responseArray['data'])."</li>";            
                echo "</ul>";
            echo "</div>"; 
            } else {
                echo "<div class='alert alert-danger'>";
                    echo "<ul>";      
                        echo "<li>".$responseArray['messages']['message']."</li>";            
                    echo "</ul>";
                echo "</div>"; 
            }
        }
    }

    // var_dump($crudItems->errors);


    if(!empty($crudItems->errors)){
        
            echo "<div class='alert alert-danger'>";
            echo "<ul>";
            foreach ($crudItems->errors as $error) {
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
            echo "</div>"; 
       
    }
?>
                <div class="col-md-9">
                <form role="form" method="post" action="" class="col-md-6 col-md-offset-3">                    
                    <fieldset>
                        <div class="form-group">
                            <h4>PHP Forms for Developers</h4>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Item Id" name="item_id" type="text" autofocus value="<?php echo $item_id; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="<?php echo date("d/m/Y")?>" name="date_added" type="date" value="<?php echo $date_added; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Item Name" name="item_name" type="text" value="<?php echo $item_name; ?>">
                        </div>
                        <div class="form-group">
                            <select name="item_category" class="form-control">
                                <option value="" <?php if($item_category == ""){echo 'selected';}?>>Select Your Category</option>
                                <option value="category_01" <?php if($item_category == "category_01"){echo 'selected';}?>>category_01</option>
                                <option value="category_02" <?php if($item_category == "category_02"){echo 'selected';}?>>category_02</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="item_location" class="form-control">
                                <option value="" <?php if($item_location == ""){echo 'selected';}?>>Select Your Location</option>
                                <option value="location_01" <?php if($item_location == "location_01"){echo 'selected';}?>>location_01</option>
                                <option value="location_02" <?php if($item_location == "location_02"){echo 'selected';}?>>location_02</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="0.00" name="item_price" type="number" step="0.01" value="<?php echo $item_price; ?>">
                        </div>
                        <div class="form-group" style="margin:0px">
                            <label>Available</label>
                        </div>
                        <div class="form-group" class="radio">                            
                            <input type="radio" name="available" value="yes" <?php if($available == 1){echo 'checked';}?>> Yes &nbsp;
                            <input type="radio" name="available" value="no" <?php if($available == 0){echo 'checked';}?>> No
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Submit" name="submit"/>
                        </div>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>

</div>



</body>
</html>