<div class="row">
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
    
    // $response is an object
    if(!empty($_SESSION['response'])){ 
        $response = $_SESSION['response'];       
        $response = json_decode($response); // this is an object 
        if(isset($response->status)){
            if($response->status == 'success'){
                echo "<div class='alert alert-success'>";
                echo $response->message;               
                if($response->mode == "edit"){                    
                    echo "<ul>";         
                        // echo "<li>"."Id : ".$response->oldData->old_id." changed to ".$response->id.".". "</li>"; 
                        echo "<li>"."Item id : ".$response->oldData->old_item_id." changed to ".$response->item_id.".". "</li>"; 
                        echo "<li>"."Date Added : ".$response->oldData->old_date_added." changed to ".$response->date_added.".". "</li>";                        
                        echo "<li>"."Item Name : ".$response->oldData->old_item_name." changed to ".$response->item_name.".". "</li>";                         
                        echo "<li>"."Item Category : ".$response->oldData->old_item_category." changed to ".$response->item_category.".". "</li>";
                        echo "<li>"."Item Location : ".$response->oldData->old_item_location." changed to ".$response->item_location.".". "</li>";
                        echo "<li>"."Item Price : ".$response->oldData->old_item_price." changed to ".$response->item_price.".". "</li>";
                        echo "<li>"."Item Available : ".$response->oldData->old_available." changed to ".ucfirst($response->available).".". "</li>";
                    echo "</ul>";

                } else {
                    echo "<ul>"; 
                        // echo "<li>"."Id : ".$response->id."</li>";         
                        echo "<li>"."Item Id : ".$response->item_id."</li>"; 
                        echo "<li>"."Date Added : ".$response->date_added."</li>";  
                        echo "<li>"."Item Name : ".$response->item_name."</li>";  
                        echo "<li>"."Item Category : ".$response->item_category."</li>";
                        echo "<li>"."Item Location : ".$response->item_location."</li>";    
                        echo "<li>"."Item Price : ".$response->item_price."</li>";  
                        echo "<li>"."Item Available : ".ucfirst($response->available)."</li>";
                        echo "</ul>";
                }

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