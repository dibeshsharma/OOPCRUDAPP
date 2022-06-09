<div class="col-md-9">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><?php if (!empty($errors)) {
                        echo ucfirst($errors['status']) . ": " . ucfirst($errors['mode']);
                    } ?>
                </h4>
            </div>
            <div class="panel-body">
                <?php include('messageDiv.php'); ?>
                <div class="row text-center">
                    <p><strong>This is the 404 page. <a href="http://localhost/local/Console/show.php">View Items</a></strong></p>
                </div>
            </div>
        </div>
    </div>
</div>