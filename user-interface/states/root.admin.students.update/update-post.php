<?php
$display = false;
$display2 = false;
if(isset($_POST['update-student']) && isset($_GET['id'])){

	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$username = $_POST['username'];
	$id = $_GET['id'];
	$result1 = $business->updateUsername($id, $username);
	$result2 = $business->updateStudent($id, $firstName, $lastName);
	$display = $result1 && $result2;
}
if(isset($_POST['update-student-password']) && isset($_GET['id'])){

	$password = $_POST['password'];
	$confirmPassword = $_POST['confirm-password'];
	$id = $_GET['id'];
	if($password == $confirmPassword){
		$result1 = $business->updateUserPassword($id, $password);
		$display2 = $result1;
	}
}
if($display == true){
	echo '
	<div class="container">
		<div class="alert alert-success">
			<label>Student successfully updated! </label>
		</div>
	</div>
	';
}
else if($display == false){}
else{
	echo '
	<div class="container">
		<div class="alert alert-danger">
			<label>Unknown error! The student has not been updated correctly</label>
		</div>
	</div>
	';
}
if($display2 == true){
	echo '
	<div class="container">
		<div class="alert alert-success">
			<label>Password changed! </label>
		</div>
	</div>
	';
}
else if($display2 == false){}
else{
	echo '
	<div class="container">
		<div class="alert alert-danger">
			<label>Unknown error! The password has not been changed</label>
		</div>
	</div>
	';
}
?>