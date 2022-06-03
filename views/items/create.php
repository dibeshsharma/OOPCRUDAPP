<?php
$id = $crudItems->get_id();
$item_id = $crudItems->get_item_id();
$date_added = $crudItems->get_date_added();
$item_name = $crudItems->get_item_name();
$item_category = $crudItems->get_item_category();
$item_location = $crudItems->get_item_location();
$item_price = $crudItems->get_item_price();
$available = $crudItems->get_available();
$mode = $crudItems->get_mode();
?>
<div class="col-md-9">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Add Items</h4>
            </div>
            <div class="panel-body">
                <?php include('messageDiv.php'); ?>
                <form role="form" method="post" action="" class="col-md-6 col-md-offset-3">
                    <fieldset>
                        <div class="form-group">
                            <h4>PHP Forms for Developers</h4>
                        </div>
                        <div class="form-group">
                        <input class="form-control" placeholder="id" name="id" type="number" autofocus value="<?php echo $id; ?>">
                        <input class="form-control" placeholder="Form Mode" name="mode" type="text" autofocus value="<?php echo $mode; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Item Id" name="item_id" type="text" autofocus value="<?php echo $item_id; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="<?php echo date("d/m/Y") ?>" name="date_added" type="date" value="<?php echo $date_added; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Item Name" name="item_name" type="text" value="<?php echo $item_name; ?>">
                        </div>
                        <div class="form-group">
                            <select name="item_category" class="form-control">
                                <option value="" <?php if ($item_category == "") {
                                                        echo 'selected';
                                                    } ?>>Select Your Category</option>
                                <option value="category_01" <?php if ($item_category == "category_01") {
                                                                echo 'selected';
                                                            } ?>>category_01</option>
                                <option value="category_02" <?php if ($item_category == "category_02") {
                                                                echo 'selected';
                                                            } ?>>category_02</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="item_location" class="form-control">
                                <option value="" <?php if ($item_location == "") {
                                                        echo 'selected';
                                                    } ?>>Select Your Location</option>
                                <option value="location_01" <?php if ($item_location == "location_01") {
                                                                echo 'selected';
                                                            } ?>>location_01</option>
                                <option value="location_02" <?php if ($item_location == "location_02") {
                                                                echo 'selected';
                                                            } ?>>location_02</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="0.00" name="item_price" type="number" step="0.01" value="<?php echo $item_price; ?>">
                        </div>
                        <div class="form-group" style="margin:0px">
                            <label>Available</label>
                        </div>
                        <div class="form-group" class="radio">
                            <input type="radio" name="available" value="yes" <?php if ($available == 1) {
                                                                                    echo 'checked';
                                                                                } ?>> Yes &nbsp;
                            <input type="radio" name="available" value="no" <?php if ($available == 0) {
                                                                                echo 'checked';
                                                                            } ?>> No
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Submit" name="submit" />
                        </div>
                        
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>