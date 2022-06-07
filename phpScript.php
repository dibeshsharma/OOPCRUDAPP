<?php 
use Console\Model\CrudItems;

//check if session has started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];
$response = [];

if($mode == 'delete'){
    echo $crudItems->get_id();
    $id = $_GET['id'];
    $response = $crudItems->deleteRecord($id); 
    $_SESSION['response'] = $response;
}

if($mode == 'edit'){
    $id = $_GET['id'];
    $crudItems->get_all_from_id($id); 
    // For edit items only
    // Add the old data to the json encode
    $old_id = $crudItems->get_id();
    $old_item_id = $crudItems->get_item_id();
    $old_date_added = $crudItems->get_date_added();
    $old_item_name = $crudItems->get_item_name(); 
    $old_item_category = $crudItems->get_item_category();
    $old_item_location = $crudItems->get_item_location();
    $old_item_price = $crudItems->get_item_price(); 
    $old_available = $crudItems->get_available();
    if($old_available == 1){
        $old_available = "Yes";
    } else {
        $old_available = "No";
    }
}

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    
$basename = basename($actual_link);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["mode"])) {
        $errors[] = "Mode Field is Required";        
    } else {
        $mode = $crudItems->dbHandler->sanitize($_POST["mode"]);
        switch ($mode) {
            case 'new':                
                $id = null;
                break;
            case 'edit':
                $id = $_POST["id"];
                $crudItems->set_id($_POST["id"]);
                break;
            default:
                $errors[] = "Wrong Mode";
            break;
        }
    }

    // item_id
    // set the item id to show old value in the form
    if (empty($_POST["item_id"])) {
        $errors[] = "Item Id Field is Required";        
    } else {
        $item_id = $crudItems->dbHandler->sanitize($_POST["item_id"]);
        $crudItems->set_item_id($item_id);
    }

    // date_added
    if (empty($_POST["date_added"])) {
        $errors[] = "Date Added Field is Required";        
    } else {
        $date_added = $crudItems->dbHandler->sanitize($_POST["date_added"]);
        $crudItems->set_date_added($date_added);
    }

    // item_name
    if (empty($_POST["item_name"])) {
        $errors[] = "Item Name Field is Required";        
    } else {
        $item_name = $crudItems->dbHandler->sanitize($_POST["item_name"]);
        $crudItems->set_item_name($item_name);
    }

    // item_category
    if (empty($_POST["item_category"])) {
        $errors[] = "Item Category Field is Required";        
    } else {
        $item_category = $crudItems->dbHandler->sanitize($_POST["item_category"]);
        $crudItems->set_item_category($item_category);
    }

    // item_location
    if (empty($_POST["item_location"])) {
        $errors[] = "Item Location Field is Required";        
    } else {
        $item_location = $crudItems->dbHandler->sanitize($_POST["item_location"]);
        $crudItems->set_item_location($item_location);
    }

    // item_price
    if (empty($_POST["item_price"])) {
        $errors[] = "Item Price Field is Required";        
    } else {
        $item_price = $crudItems->dbHandler->sanitize($_POST["item_price"]);
        $crudItems->set_item_price($item_price);
    }

    // available
    if (empty($_POST["available"])) {
        $errors[] = "Available Field is Required";        
    } else {
        $available = $crudItems->dbHandler->sanitize($_POST["available"]);
        $crudItems->set_available($available);
    }

    if(!empty($errors)){    
        $errors = $errors; 
        $messages = [];   
    } else {    
        $postData = array(
            "id" => $id,
            "item_id" => $item_id,
            "date_added" => $date_added,
            "item_name" => $item_name,
            "item_category" => $item_category,
            "item_location" => $item_location,
            "item_price" => $item_price,
            "available" => $available,
            "mode" => $mode
        ); 

        // Get the server side response
        $response = submitForm($postData);


        $responseEdit = json_decode($response, true);
        
        
        if($responseEdit['mode'] == "edit"){            
            $responseEdit['oldData'] = [
                'old_id' => $old_id, 
                'old_item_id' => $old_item_id,
                'old_date_added' =>$old_date_added, 
                'old_item_name' => $old_item_name, 
                'old_item_category' => $old_item_category, 
                'old_item_location' => $old_item_location, 
                'old_item_price' => $old_item_price, 
                'old_available' => $old_available, 
            ];
            $response = json_encode($responseEdit);
        } 

        $_SESSION['response'] = $response;
        
        if($mode == "new"){
            //Reset the form
            $crudItems = new CrudItems();
            $crudItems->set_mode("new");
        } else if($mode == "edit") {
            header("Location: show.php");
            die();
        } else if($mode == "delete") {
            header("Location: show.php");
            exit();
        } else {
            header("Location: default.php");
            exit();
        }
    }
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