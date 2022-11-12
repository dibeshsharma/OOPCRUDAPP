<?php
$id = $crudItems->get_id();
$mode = $crudItems->get_mode();
$item_id = $crudItems->get_item_id();
$date_added = $crudItems->get_date_added();
$item_name = $crudItems->get_item_name();
$item_category = $crudItems->get_item_category();
$item_location = $crudItems->get_item_location();
$item_price = $crudItems->get_item_price();
$available = $crudItems->get_available();
$formAction = $pathinfo == "index" ? "Add Items" : "Edit Items";
$locations = $locations->get_all(); // $locations = new Locations();
$categories = $categories->get_all(); // $categories = new Categories();
// echo "<pre>";
// var_dump($categories);
// echo "</pre>";
?>
<div class="col-md-9">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><?php echo $formAction; ?></h4>
            </div>
            <div class="panel-body">
                <?php include('messageDiv.php'); ?>
                <form role="form" method="post" action="" class="col-md-6 col-md-offset-3">
                    <fieldset>
                        <div class="form-group">
                            <h4>King - Add Crud Items</h4>
                        </div>
                        <div class="form-group">
                        <input class="form-control" placeholder="id" name="id" type="hidden"  value="<?php echo $id; ?>">
                        <input class="form-control" placeholder="Form Mode" name="mode" type="hidden" value="<?php echo $mode; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Item Id" name="item_id" type="text" autofocus value="<?php echo $item_id; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="<?php echo date("d/m/Y") ?>" name="date_added" type="date" value="<?php echo $date_added; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Item Name" name="item_name" type="text" value="<?php echo $item_name; ?>">
                        </div>
                        <div class="form-group">
                            <select name="item_category" class="form-control">
                                <option value=""> Select Your Category</option>
                                <?php
                                    foreach ($categories['data'] as $category) { 
                                        if($category['id'] == $item_category ){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option value =$category[id] $selected >" . $category['category'] . "</option>";                                        
                                    }
                                ?>
                            </select>
                        </div>                        
                        <div class="form-group">
                            <select name="item_location" class="form-control">
                                <option value=""> Select Your Location</option>
                                <?php
                                    foreach ($locations['data'] as $location) { 
                                        if($location['id'] == $item_location ){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option value =$location[id] $selected >" . $location['location'] . "</option>";                                        
                                    }
                                ?>
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
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="<?php echo $formAction; ?>" name="submit" />
                        </div>
                        
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>