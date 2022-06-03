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
?>