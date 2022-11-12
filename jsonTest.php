<?php
    $errors = [];
    $errors['message'][] = "test 1";
    $errors['message'][] = "test 2";
    echo "<pre>";
    var_dump($errors);
    echo "</pre>";
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

    ?>
