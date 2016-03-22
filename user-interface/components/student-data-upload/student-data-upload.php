<div class="container">
	<div class="well well-sm"><label>Import Students</label></div>
	<form class="form-horizontal form-group" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		<label for="inputFile" class="col-sm-2 control-label">Browse XLS file</label>
		<div class="col-sm-10 form-group">
			<input type="file" name="students" class="form-control" id="file" accept=".xls, application/vnd.ms-excel" required/>
		</div>
		<div class="col-sm-12 form-group">
			<button class="btn btn-lg btn-success center-block" type="submit" name="import">Import</button>
		</div>
	</form>
</div>

<?php require('student-data-upload-post.php');?>