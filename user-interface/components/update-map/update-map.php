<div class="container">
	<form class="form-horizontal form-group" role="form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
      	<div class="col-sm-12 form-group">
        	<button class="btn btn-lg btn-warning center-block" type="submit" name="generate">Update Map</button>
      	</div>
  	</form>
</div>

<?php require('update-map-post.php'); ?>