<?php 
if(!empty($errors) || !empty($_SESSION['response'])){ 
echo "<div class=\"row\">";
echo "<div class=\"col-md-10 col-md-offset-1\">";   
    //Error messages for empty form feilds
    if(!empty($errors)){ 
        $errors = json_encode($errors); 
        //convert array to json object
       $errors = json_decode($errors); 
        echo "<div class='alert alert-danger'>";
            echo "<p>Please fix the errors below.</p>";
            echo "<ul>";                
                foreach ($errors->message as $error) {
                    echo "<li>".$error."</li>";
                }
            echo "</ul>";
        echo "</div>"; 
        $errors = [];
    }        
    
    
    if(!empty($_SESSION['response'])){ 
        // this is an array
        // array( 
        //   'status' => string 'success'
        //   'message' => string 'message'
        // )

        $response = $_SESSION['response']; 
            
        $response = json_encode($response); 

         //convert array to json object
        $response = json_decode($response); 

        if(isset($response->status)){
            if($response->status == 'success'){

                $response->date_added = date_create($response->date_added);
                $response->date_added = date_format($response->date_added,"d/m/Y"); 
                $category_name = $categories->get_category_name_from_id($response->item_category);
                $location_name = $locations->get_location_name_from_id($response->item_location);

                if($response->mode == "edit"){
                    // only edit have oldData in response
                    $response->oldData->old_date_added = date_create($response->oldData->old_date_added);
                    $response->oldData->old_date_added = date_format($response->oldData->old_date_added,"d/m/Y");
                    $old_category_name = $categories->get_category_name_from_id($response->oldData->old_item_category);
                    $old_location_name = $locations->get_location_name_from_id($response->oldData->old_item_location);
                    echo "<div class='alert alert-success'>";                        
                        echo $response->message. " [" ."<strong>Item Id : ".$response->item_id."</strong>"."]";             
                        echo "<ul>";
                            echo "<li>"."Date Added : <strong>".$response->oldData->old_date_added."</strong> changed to <strong>".$response->date_added."</strong>.". "</li>";                        
                            echo "<li>"."Item Name : <strong>".$response->oldData->old_item_name."</strong> changed to <strong>".$response->item_name."</strong>.". "</li>";                         
                            echo "<li>"."Item Category : <strong>".$old_category_name."</strong> changed to <strong>".$category_name."</strong>.". "</li>";
                            echo "<li>"."Item Location : <strong>".$old_location_name."</strong> changed to <strong>".$location_name."</strong>.". "</li>";
                            echo "<li>"."Item Price : <strong>".$response->oldData->old_item_price."</strong> changed to <strong>".$response->item_price."</strong>.". "</li>";
                            echo "<li>"."Item Available : <strong>".$response->oldData->old_available."</strong> changed to <strong>".ucfirst($response->available)."</strong>.". "</li>";
                        echo "</ul>";
                    echo "</div>";
                } else{
                    echo "<div class='alert alert-info'>";
                    echo $response->message. " [" ."<strong>Item Id : ".$response->item_id."</strong>"."]";
                    echo "<ul>";                        
                        echo "<li>"."Date Added : <strong>".$response->date_added."</strong></li>";  
                        echo "<li>"."Item Name : <strong>".$response->item_name."</strong></li>";  
                        echo "<li>"."Item Category : <strong>".$category_name."</strong></li>";
                        echo "<li>"."Item Location : <strong>".$location_name."</strong></li>";    
                        echo "<li>"."Item Price : <strong>".$response->item_price."</strong></li>";  
                        echo "<li>"."Item Available : <strong>".ucfirst($response->available)."</strong></li>";
                    echo "</ul>";
                    echo "</div>";
                }
             
            } else {
                echo "<div class='alert alert-danger'>";
                echo $response->message;
                echo "</div>"; 
            }
        }        
        unset($_SESSION['response']);
    }
echo "</div>";
echo "</div>";
}
?>