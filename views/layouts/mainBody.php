<!-- This is the main body -->

    <?php
    switch ($basename) {
        case 'index.php':
            include('views/items/create.php'); 
            break;
        case 'show.php':
            include('views/items/view.php'); 
            break; 
        case 'edit.php':
            include('views/items/create.php'); 
            break;
        case 'delete.php':
            include('views/items/delete.php'); 
            break;  
        default:
            include('views/items/default.php'); 
            break;
    }
    ?>
