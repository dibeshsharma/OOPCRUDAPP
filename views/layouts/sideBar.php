<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><?php echo 'King CRUD ITEMS'; ?></h4> 
			<div class="clearfix"></div>  
		</div>    
		<div class="panel-body"> 
			<ul class="nav flex-column">
				<?php
					switch ($basename) {
						case 'index.php':
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."local/Console/index.php"." class=\"nav-link active\"".">Add Items</a>";
							echo "</li>";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."local/Console/show.php"." class=\"nav-link\"".">View Items</a>";
							echo "</li>";
							break;
						case 'show.php':
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."local/Console/index.php"." class=\"nav-link\"".">Add Items</a>";
							echo "</li>";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."local/Console/show.php"." class=\"nav-link active\"".">View Items</a>";
							echo "</li>";
								break;        
						default:
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."local/Console/index.php"." class=\"nav-link active\"".">Add Items</a>";
							echo "</li>";
							echo "<li class=\"nav-item\">";
							echo "<a href=$root"."local/Console/show.php"." class=\"nav-link\"".">View Items</a>";
							echo "</li>";
							break;
					}
				?>
			</ul>												   
		</div> 
	</div>
</div>


