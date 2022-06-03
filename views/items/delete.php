<?php
$id = $_GET['id'];
?>
<div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Delete Item</h4>
            </div>
            <div class="panel-body">
            <?php include('messageDiv.php'); ?>
               <?php echo $id; ?>
            </div>
        </div>

</div>
