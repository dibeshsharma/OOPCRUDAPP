<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><?php echo 'King CRUD ITEMS'; ?></h4> 
			<div class="clearfix"></div>  
		</div>    
		<div class="panel-body"> 
			<ul class="nav flex-column">
				<?php
					switch ($pathinfo) {
						case 'index':
							$addItemsLink = "active";
							$showItemsLink = "";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."OOPCRUDAPP\index.php"." class=\"nav-link $addItemsLink\"".">Add Items</a>";
							echo "</li>";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."OOPCRUDAPP\show.php"." class=\"nav-link $showItemsLink\"".">View Items</a>";
							echo "</li>";
							break;
						case 'show':
							$addItemsLink = "";
							$showItemsLink = "active";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."OOPCRUDAPP\index.php"." class=\"nav-link  $addItemsLink\"".">Add Items</a>";
							echo "</li>";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."OOPCRUDAPP\show.php"." class=\"nav-link $showItemsLink\"".">View Items</a>";
							echo "</li>"; 
							break; 
						default:
							$addItemsLink = "";
							$showItemsLink = "";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."OOPCRUDAPP\index.php"." class=\"nav-link $addItemsLink\"".">Add Items</a>";
							echo "</li>";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."OOPCRUDAPP\show.php"." class=\"nav-link $showItemsLink\"".">View Items</a>";
							echo "</li>";
							break;
					}
				?>
			</ul>												   
		</div> 
	</div>
</div>


