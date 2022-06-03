<?php
  $items = $crudItems->get_all();  
  //Action Button
  $actionButton = '<div class="btn-group">
    <button type="button" class="btn btn-primary">Edit</button>
    <button type="button" class="btn btn-danger">Delete</button>
  </div>';
?>
<div class="col-md-9">
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>View Items</h4>        
    </div>    
    <div class="panel-body">
      <?php include('messageDiv.php') ?>
      <table class="table table-striped table-bordered table-hover">
        <tr>
          <th>Id</th>
          <th>Item Id</th>
          <th>Created Date</th>
          <th>Item Name</th>
          <th>Item Category</th>
          <th>Item Location</th>
          <th>Item Price</th>
          <th>Available</th>
          <th>Action</th>
        </tr>
        <?php 
        if(!empty($items)){
          foreach ($items as $item) {
            echo "<tr>";
              echo "<td>".$item['id']."</td>";
              echo "<td>".$item['item_id']."</td>";
              echo "<td>".$item['date_added']."</td>";
              echo "<td>".$item['item_name']."</td>";
              echo "<td>".$item['item_category']."</td>";
              echo "<td>".$item['item_location']."</td>";
              echo "<td>".$item['item_price']."</td>";
              echo "<td>".$item['available']."</td>";
              echo "<td>";
              echo "<a href=$root"."local/Console/edit.php?id=".$item['id']." class=\"btn btn-warning\"".">Edit</a>";
              echo " ";
              echo "<a href=$root"."local/Console/delete.php?id=".$item['id']." class=\"btn btn-danger\"".">Delete</a>";
              echo "</td>";
          } 
        }
  
        ?>
      </table>
    </div>
</div>
</div>