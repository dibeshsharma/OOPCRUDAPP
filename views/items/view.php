<?php
$items = $crudItems->get_all();
?>
<div class="col-md-9">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4>View Items</h4>
    </div>
    <div class="panel-body">
      <?php include('messageDiv.php') ?>
      <?php if (!empty($items)) { ?>
        <div class="row">
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
            foreach ($items as $item) {

              if ($item['available'] == "1") {
                $item['available'] = "Yes";
              } else {
                $item['available'] = "No";
              }
              echo "<tr>";
              echo "<td>" . $item['id'] . "</td>";
              echo "<td>" . $item['item_id'] . "</td>";
              echo "<td>" . $item['date_added'] . "</td>";
              echo "<td>" . $item['item_name'] . "</td>";
              echo "<td>" . $item['item_category'] . "</td>";
              echo "<td>" . $item['item_location'] . "</td>";
              echo "<td>" . $item['item_price'] . "</td>";
              echo "<td>" . $item['available'] . "</td>";
              echo "<td>";
              echo "<a href=$root" . "local/Console/edit.php?id=" . $item['id'] . " class=\"btn btn-warning\"" . ">Edit</a>";
              echo " ";
              echo "<a href=$root" . "local/Console/delete.php?id=" . $item['id'] . " class=\"btn btn-danger\"" . ">Delete</a>";
              echo "</td>";
              echo "</tr>";
            }
            ?>
          </table>
        </div>
      <?php } else { ?>
        <div class="row text-center">
          <p><strong>The list is empty. Please add the items. <a href="http://localhost/local/Console/index.php">Add Items</a></strong></p>
        </div>
      <?php } ?>
    </div>
  </div>
</div>