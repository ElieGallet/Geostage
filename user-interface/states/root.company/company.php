<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-company.php');?>

<!doctype html>
<html>
<head>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root/root-head.php');?>
	<link rel="stylesheet" href="/PIFE/user-interface/vendors/bootstrap-validator/dist/css/bootstrapValidator.min.css">

</head>
<body>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root/root.php');?>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/components/company-navbar/company-navbar.html');?>
	<?php require('company-post.php');?>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/components/offer-upload/offer-upload.php');?>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/components/offer-download/offer-download.php');?>

	<?php
	$user = $business->getUser($info['id_user']);
	$id = $user['id'];
	$user = $business->getUser($id);
	$company = $business->getCompany($id);
	?>
	<div class="container">
		<div class="well well-sm"><label>Update your information</label></div>
		<form class="form-horizontal form-group" role="form" method="post">

			<label for="inputSIRET" class="col-sm-2 control-label">SIRET</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputSIRET" name="siret" class="form-control" value="'.$company['siret'].'" required autofocus>')
				?>
			</div>

			<label for="inputName" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputName" name="name" class="form-control" value="'.$company['name'].'" required autofocus>')
				?>
			</div>

			<label for="inputDescription" class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputDescription" name="description" class="form-control" value="'.$company['description'].'" autofocus>')
				?>
			</div>

			<label for="inputPhone" class="col-sm-2 control-label">Phone</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputPhone" name="phone" class="form-control" value="'.$company['phone'].'" required autofocus>')
				?>
			</div>

			<label for="inputEmail" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="email" id="inputEmail" name="email" class="form-control" value="'.$company['email'].'" autofocus>')
				?>
			</div>

			<label for="inputTutor" class="col-sm-2 control-label">Tutor</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputTutor" name="tutor" class="form-control" value="'.$company['tutor'].'" required autofocus>')
				?>
			</div>

			<label for="inputAddress" class="col-sm-2 control-label">Address</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputAddress" name="address" class="form-control" value="'.$company['address'].'" autofocus>')
				?>
			</div>

			<label for="inputStreet" class="col-sm-2 control-label">Street</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputStreet" name="street" class="form-control" value="'.$company['street'].'" autofocus>')
				?>
			</div>

			<label for="inputCedex" class="col-sm-2 control-label">Cedex</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputCedex" name="cedex" class="form-control" value="'.$company['cedex'].'" autofocus>')
				?>
			</div>

			<label for="inputPostalCode" class="col-sm-2 control-label">Postal Code</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputPostalCode" name="postal-code" class="form-control" value="'.$company['postal_code'].'" required autofocus>')
				?>
			</div>

			<label for="inputCity" class="col-sm-2 control-label">Town</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputCity" name="city" class="form-control" value="'.$company['city'].'" required autofocus>')
				?>
			</div>

			<label for="inputCountry" class="col-sm-2 control-label">City</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputCountry" name="country" class="form-control" value="'.$company['country'].'" required autofocus>')
				?>
			</div>

			<label for="inputWebsite" class="col-sm-2 control-label">Website</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputWebsite" name="website" class="form-control" value="'.$company['website'].'" autofocus>')
				?>
			</div>

			<label for="inputSector" class="col-sm-2 control-label">Sector</label>
			<div class="col-sm-10 form-group">
				<?php echo('<select id="inputSector" name="sector" class="form-control" required>
					<option value="'.$company['sector'].'" selected>'.$company['sector'].'</option>
					<option value="DS">Déficience Sensorielle</option>
					<option value="O">Oncologie</option>
					<option value="DP">Déficience Physiologique</option>
					<option value="DM">Déficience Motrice</option>
					<option value="V">Vieillissement</option>
					<option value="DC">Déficience Comportementale</option>
					<option value="AIS">AIS</option>
					<option value="OTHER">Autre</option>
				</select>');
				?>
			</div>

			<label for="inputLevel" class="col-sm-2 control-label">Level</label>
			<div class="col-sm-10 form-group">
				<?php
				echo('<select id="inputLevel" name="level" class="form-control" required>
					<option value="'.$company['level'].'" selected>'.$company['level'].'</option>
					<option value="L2">License 2</option>
					<option value="L3">License 3</option>
					<option value="M1">Master 1</option>
					<option value="M2">Master 2</option>
					<option value="OTHER">Autre</option>
				</select>');
				?>
			</div>

			<label for="inputUsername" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10 form-group">
				<?php
				echo ('<input type="text" id="inputUsername" name="username" class="form-control" value="'.$user['username'].'" required autofocus>')
				?>
			</div>

					<!--label for="inputEmail" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10 form-group">
						<input type="email" id="inputEmail" name="email" class="form-control" placeholder="email" required autofocus>
					</div-->
					<div class="col-sm-12 form-group">
						<button class="btn btn-lg btn-primary center-block" type="submit" name="update-company">Update</button>
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
					<!-- #messages is where the messages are placed inside -->
					<div class="form-group">
						<div class="col-md-10 col-md-offset-2">
							<div id="messages"></div>
						</div>
					</div>
					<div class="col-sm-12 form-group">
						<button class="btn btn-lg btn-primary center-block" type="submit" name="update-company-password">Change password</button>
					</div>
					<script>
						$(document).ready(function() {
							$('#contactForm').bootstrapValidator({
								container: '#messages',
								feedbackIcons: {
									valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								},
								fields: {
									confirmPassword: {
										validators: {
											notEmpty: {
												message: 'The password and its confirm are not the same'
											},
											identical: {
												field: 'password',
												message: 'The password and its confirm are not the same'
											}
										}
									}
								}
							});
						});
					</script>
				</form>      
			</div>

			<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root/root-scripts.php');?>
			<script src="/PIFE/user-interface/vendors/bootstrap-validator/dist/js/bootstrapValidator.min.js"></script>

		</body>
		</html>
