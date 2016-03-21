<?php
if(isset($_POST['create-company'])){
	$siret = $_POST['siret'];
	$sector = $_POST['sector'];
	$level = $_POST['level'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$tutor = $_POST['tutor'];
	$address = $_POST['address'];
	$street = $_POST['street'];
	$cedex = $_POST['cedex'];;
	$postalCode = $_POST['postal-code'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	$website = $_POST['website'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirm-password'];
	if($password === $confirmPassword){
		if(!empty($siret)){
			if(!empty($username)){
				if(!$business->doesCompanyExist($siret)){
					if(!$business->doesUsernameExist($username)){
						$business->createUser($username, $password);
						$id = $business->getUserId($username);
						$result = $business->createCompany($id, $siret, $sector, $level, $name, $description, $phone, $email, $tutor, $address, $street, $cedex, $postalCode, $city, $country, $website);
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
							<label>A company corresponding to this SIRET is already in the database! The company has not been created</label>
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
			echo ('<div class="container">
				<div class="alert alert-danger">
					<label>No SIRET given, the company has not been created</label>
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