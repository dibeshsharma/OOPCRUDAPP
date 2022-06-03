<?php
   $connection_mysql = mysqli_connect("localhost","root","","test");
   
   if (mysqli_connect_errno($connection_mysql)){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   
   $sql = "SELECT `id`, `item_id`, `date_added`, `item_name`, `item_category`, `item_location`, `item_price`, `available` FROM `ds_crud_items` WHERE 1";
   $result = mysqli_query($connection_mysql,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_NUM);
   
   print $row[0];
   print "\n";
   print $row[1];
   
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   print $row["item_id"];
   print "\n";
   print $row["item_name"];
   
   mysqli_free_result($result);
   mysqli_close($connection_mysql);
?>