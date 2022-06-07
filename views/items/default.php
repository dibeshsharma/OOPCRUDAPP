<?php
$id = $_GET['id'];
echo $id;
echo "<br/>";

echo "basename : ".$basename;
echo "<br/>";

$request = $_SERVER['REQUEST_URI'];
echo "REQUEST_URI : ".$request;
echo "<br/>";

echo "actual_link : ".$actual_link;
echo "<br/>";

echo "root : ".$root;
echo "<br/>";



?>
<div class="col-md-9">
<div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Default Page</h4>
            </div>
            <div class="panel-body">            
               This is the Default page. 
            </div>
        </div>

</div>
</div>


