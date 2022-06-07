<div class="col-md-8 col-md-offset-2">
<?php 
    echo "This is the message Div.";
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
    
    // $response is an object
    if(!empty($_SESSION['response'])){ 
        $response = $_SESSION['response'];
        var_dump($response);
        echo "<br/>";
        $response = json_decode($response); // this is an object  
        echo $response->mode;
        echo "<br/>";
        if(isset($response->status)){
            if($response->status == 'success'){
                echo "<div class='alert alert-success'>";
                echo $response->message;
                echo "<ul>";         
                    echo "<li>"."Item Id : ".$response->item_id."</li>";  
                    echo "<li>"."Item Name : ".$response->item_name."</li>";       
                echo "</ul>";
            echo "</div>"; 
            } else {
                echo "<div class='alert alert-danger'>";
                echo $response->message;
                echo "<ul>";         
                    echo "<li>"."Item Id : ".$response->item_id."</li>";  
                    echo "<li>"."Item Name : ".$response->item_name."</li>";       
                echo "</ul>";
                echo "</div>"; 
            }
        }        
        unset($_SESSION['response']);
    }
?>
</div>