<!-- This is the main body -->
    <?php
    if(!empty($errors)){
        if($errors['mode'] == "ID Check" && $errors['status'] == "error"){
            include('views/items/404.php');
            return;
        } elseif ($errors['mode'] == "Invalid Mode" && $errors['status'] == "error") {
            include('views/items/404.php');
            return;
        } else {
            // do nothing
        }        
    }

    switch ($pathinfo) {
        case 'index':
            include('views/items/create.php');            
            break;
        case 'show':
            include('views/items/view.php'); 
            break; 
        case 'edit':
            include('views/items/create.php'); 
            break;
        case 'delete':
            include('views/items/view.php'); 
            break;  
        default:
            include('views/items/default.php'); 
            break;
    }
    ?>
