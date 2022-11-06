<?php
$results = $crudItems->get_all();
?>
<div class="col-md-9">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4>View Items</h4>
    </div>
    <div class="panel-body">
      <?php include('messageDiv.php') ?>
      <?php if ($results['status'] == "success") { ?>
        <div class="row">
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Id</th>
              <th>ITEM ID</th>
              <th>CREATED DATE</th>
              <th>ITEM NAME</th>
              <th>ITEM CATEGORY</th>
              <th>ITEM LOCATION</th>
              <th>ITEM PRICE</th>
              <th>AVAILABLE</th>
              <th>ACTION</th>
            </tr>
            <?php
            $i = 1;
            foreach ($results['data'] as $item) {

              if ($item['available'] == "1") {
                $item['available'] = "Yes";
              } else {
                $item['available'] = "No";
              }

              $category_name = $categories->get_category_name_from_id($item['item_category']);
              $location_name = $locations->get_location_name_from_id($item['item_location']);                   


              $date_added = date_create($item['date_added']);
              $date_added = date_format($date_added,"d/m/Y");
              echo "<tr>";
              echo "<td>" . $i. "</td>";
              echo "<td>" . $item['item_id'] . "</td>";
              echo "<td>" . $date_added . "</td>";
              echo "<td>" . $item['item_name'] . "</td>";
              echo "<td>" . $category_name . "</td>";
              echo "<td>" . $location_name . "</td>";
              echo "<td>" . $item['item_price'] . "</td>";
              echo "<td>" . $item['available'] . "</td>";
              echo "<td>";
              echo "<a href= $root" . "OOPCRUDAPP/edit.php?id=" . $item['id'] . " class=\"btn btn-warning\"" . ">Edit</a>";
              echo " ";
              echo "<a href=$root" . "OOPCRUDAPP/delete.php?id=" . $item['id'] . " class=\"btn btn-danger\"" . ">Delete</a>";
              echo "</td>";
              echo "</tr>";
              $i++;
            }
            ?>
          </table>
        </div>
      <?php } else { ?>
        <div class="row text-center">
          <p><strong>The list is empty. Please add the items. <a href=<?php echo $root."OOPCRUDAPP\index.php"; ?>>Add Items</a></strong></p>
        </div>
      <?php } ?>
    </div>
  </div>
</div>