<?php
$display = false;
$display2 = false;
$user = $business->getUser($info['id_user']);
if(isset($_POST['update-company'])){

	$siret = $_POST['siret'];
	$name = $_POST['name'];
	$name = str_replace("'", "''", $name);
	$name = str_replace("é", "e", $name);

	$description = $_POST['description'];
	$description = str_replace("'", "''", $description);

	$phone = $_POST['phone'];
	$tutor = $_POST['tutor'];
	$email = $_POST['email'];

	$address = $_POST['address'];
	$address = str_replace("'", "''", $address);

	$street = $_POST['street'];
	$street = str_replace("'", "''", $street);

	$cedex = $_POST['cedex'];
	$postalCode= $_POST['postal-code'];

	$city = $_POST['city'];
	$city = str_replace("'", "''", $city);

	$country = $_POST['country'];
	$country= str_replace("'", "''", $country);

	$website = $_POST['website'];
	$sector = $_POST['sector'];
	$level = $_POST['level'];
	$username = $_POST['username'];

	$id = $user['id'];
	$result1 = $business->updateUsername($id, $username);
	$result2 = $business->updateCompany($id, $siret, $sector, $level, $name, $description, $phone, $email, $tutor, $address, $street, $cedex, $postalCode, $city, $country, $website);

	$display = $result1 && $result2;
}

if(isset($_POST['update-company-password'])){
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirm-password'];
	$id = $user['id'];
	if($password == $confirmPassword){
		$result1 = $business->updateUserPassword($id, $password);
		$display2 = $result1;
	}
}

if($display == true){
	echo '
	<div class="container">
		<div class="alert alert-success">
			<label>Company successfully updated! </label>
		</div>
	</div>
	';
}
else if($display == false){
}
else{
	echo '
	<div class="container">
		<div class="alert alert-danger">
			<label>Unknown error! The company has not been updated correctly</label>
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
else if($display2 == false){
}
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