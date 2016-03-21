<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-admin.php');?>

<!doctype html>
<html>
<head>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.students/students-head.php');?>

</head>
<body>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.students/students.php');?>
	<?php require('create-post.php');?>

	<div class="container">
		<div class="well well-sm"><label>Create a student</label></div>
		<form class="form-horizontal form-group" role="form" method="post">

			<label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputFirstName" name="firstname" class="form-control" placeholder="first name" required autofocus>
			</div>

			<label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputLastname" name="lastname" class="form-control" placeholder="last name" required autofocus>
			</div>

			<label for="inputUsername" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputUsername" name="username" class="form-control" placeholder="username" required autofocus>
			</div>

			<label for="inputPassword" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10 form-group">
				<input type="password" id="inputPassword" name="password" class="form-control" placeholder="password" required autofocus>
			</div>

			<label for="inputPassword2" class="col-sm-2 control-label">Confirm Password</label>
			<div class="col-sm-10 form-group">
				<input type="password" id="inputPassword2" name="password2" class="form-control" placeholder="password again" required autofocus>
			</div>

			<div class="col-sm-12 form-group">
				<button class="btn btn-lg btn-primary center-block" type="submit" name="create-student">Create</button>
			</div>
		</form>
		</div>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.students/students-scripts.php');?>
	<script src="create.js"></script>

</body>
</html>