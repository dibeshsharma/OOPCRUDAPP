<div class="col-md-8 col-md-offset-2">
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

    //var_dump($_SESSION['delete']);

    if(!empty($_SESSION['delete'])){         
        $response = $_SESSION['delete'];
        if(isset($response['status'])){
            if($response['status'] == 'success'){
                echo "<div class='alert alert-success'>";
                echo "<ul>";         
                    echo "<li>".$response['message']."</li>";        
                echo "</ul>";
            echo "</div>"; 
            } else {
                echo "<div class='alert alert-danger'>";
                    echo "<ul>";      
                        echo "<li>".$response['message']."</li>";            
                    echo "</ul>";
                echo "</div>"; 
            }
        }
        unset($_SESSION['delete']);
    }

    if(!empty($_SESSION['response'])){          
        $responseArray = $_SESSION['response']; 
        if(isset($responseArray['messages']['status'])){
            if($responseArray['messages']['status'] == 'success'){
                echo "<div class='alert alert-success'>";
                echo "<ul>";         
                    echo "<li>".$responseArray['messages']['message']."</li>";        
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
        unset($_SESSION['response']);
    }
?>
</div>