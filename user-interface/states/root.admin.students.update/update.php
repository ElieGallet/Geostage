<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/auth-admin.php');?>

<!doctype html>
<html>
<head>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root.admin.companies/companies-head.php');?>
	<link rel="stylesheet" href="/user-interface/vendors/bootstrap-validator/dist/css/bootstrapValidator.min.css"/>

</head>
<body>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root.admin.companies/companies.php');?>
	<?php require('update-post.php');?>

	<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$user = $business->getUser($id);
		$student = $business->getStudent($id);
	}
	?>
	<div class="container">
		<div class="well well-sm"><label>Create a student</label></div>
		<form class="form-horizontal form-group" role="form" method="post">

			<label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputFirstName" name="firstname" class="form-control" value="'.$student['first_name'].'" required autofocus>')
				?>
			</div>

			<label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputLastName" name="lastname" class="form-control" value="'.$student['last_name'].'" required autofocus>')
				?>
			</div>

			<label for="inputUsername" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputUsername" name="username" class="form-control" value="'.$user['username'].'" required autofocus>')
				?>
			</div>
			<div class="col-sm-12 form-group">
				<button class="btn btn-lg btn-primary center-block" type="submit" name="update-student">Update</button>
			</div>
		</form>
		<form id="contactForm" method="post" class="form-horizontal">
			<label class="col-md-2 control-label">Password</label>
			<div class="col-md-10 form-group">
				<input type="password" class="form-control" name="password" required autofocus />
			</div>
			<label class="col-md-2 control-label">Confirm Password</label>
			<div class="col-md-10 form-group">
				<input type="password" class="form-control" name="confirm-password" required autofocus/>
			</div>
			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<div id="messages"></div>
				</div>
			</div>
			<div class="col-sm-12 form-group">
				<button class="btn btn-lg btn-primary center-block" type="submit" name="update-student-password">Change password</button>
			</div>
		</form>
	</form>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root.admin.companies/companies-scripts.php');?>
<script src="/user-interface/vendors/bootstrap-validator/dist/js/bootstrapValidator.min.js"></script>
<script src="update.js"></script>

</body>
</html>