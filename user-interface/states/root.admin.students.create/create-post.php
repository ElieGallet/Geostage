<?php
if(isset($_POST['create-student'])){

	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$username = $_POST['username'];

	if($password === $confirmPassword){
		if(!empty($username)){
			if(!$business->doesUsernameExist($username)){
				$business->createUser($username, $password);
				$id = $business->getUserId($username);
				$result = $business->createStudent($id, $firstName, $lastName);
				if($result){
					echo ('<div class="container">
						<div class="alert alert-success">
							<label>Company successfully created! </label>
						</div>
					</div>');
				}
				else{
					echo ('<div class="container">
						<div class="alert alert-danger">
							<label>Unknown error! The company has not been created</label>
						</div>
					</div>');
				}
			}
			else{
				echo ('<div class="container">
					<div class="alert alert-danger">
						<label>This username already exists</label>
					</div>
				</div>');
			}
		}
		else{
			echo ('<div class="container">
				<div class="alert alert-danger">
					<label>No username given</label>
				</div>
			</div>');
		}
	}
	else{
		echo('<div class="container">
			<div class="alert alert-danger">
				<label>Passwords do not match, the company has not been created</label>
			</div>
		</div>');
	}
}
?>