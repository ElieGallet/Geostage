<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/init.php');?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/auth-admin.php');?>

<!doctype html>
<html>
<head>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root.admin.companies/companies-head.php');?>
	
</head>
<body>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root.admin.companies/companies.php');?>
	<?php require ('create-post.php');?>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/components/pstage-data-upload/pstage-data-upload.php');?>

	<div class="container">
		<div class="well well-sm">
			<label>Create a company manually</label>
		</div>
		<form class="form-horizontal form-group" role="form" method="post">

			<label for="inputSIRET" class="col-sm-2 control-label">SIRET</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputSIRET" name="siret" class="form-control" placeholder="SIRET number" required autofocus/>
			</div>

			<label for="inputName" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputName" name="name" class="form-control" placeholder="company name" required/>
			</div>

			<label for="inputDescription" class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputDescription" name="description" class="form-control" placeholder="description of the company..."/>
			</div>

			<label for="inputPhone" class="col-sm-2 control-label">Phone</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputPhone" name="phone" class="form-control" placeholder="phone number"/>
			</div>

			<label for="inputEmail" class="col-sm-2 control-label">Email Address</label>
			<div class="col-sm-10 form-group">
				<input type="email" id="inputEmail" name="email" class="form-control" placeholder="email address"/>
			</div>

			<label for="inputTutor" class="col-sm-2 control-label">Tutor</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputTutor" name="tutor" class="form-control" placeholder="name of the person to contact"/>
			</div>

			<label for="inputAddress" class="col-sm-2 control-label">Address</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputAddress" name="address" class="form-control" placeholder="address"/>
			</div>

			<label for="inputStreet" class="col-sm-2 control-label">Street</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputStreet" name="street" class="form-control" placeholder="street"/>
			</div>

			<label for="inputCedex" class="col-sm-2 control-label">Cedex</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputCedex" name="cedex" class="form-control" placeholder="cedex"/>
			</div>

			<label for="inputPostalCode" class="col-sm-2 control-label">Postal Code</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputPostalCode" name="postal-code" class="form-control" placeholder="postal Code"/>
			</div>

			<label for="inputCity" class="col-sm-2 control-label">City</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputCity" name="city" class="form-control" placeholder="city"/>
			</div>

			<label for="inputCountry" class="col-sm-2 control-label">Country</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputCountry" name="country" class="form-control" placeholder="country"/>
			</div>

			<label for="inputWebsite" class="col-sm-2 control-label">Website</label>
			<div class="col-sm-10 form-group">
				<input type="text" id="inputWebsite" name="website" class="form-control" placeholder="website url"/>
			</div>

			<label for="inputSector" class="col-sm-2 control-label">Sector</label>
			<div class="col-sm-10 form-group">
				<select id="inputSector" name="sector" class="form-control" required>
					<option value="" selected disabled>Selectionner un thème...</option>
					<option value="DS">Déficience Sensorielle</option>
					<option value="O">Oncologie</option>
					<option value="DP">Déficience Physiologique</option>
					<option value="DM">Déficience Motrice</option>
					<option value="V">Vieillissement</option>
					<option value="DC">Déficience Comportementale</option>
					<option value="AIS">AIS</option>
					<option value="OTHER">Autre</option>
				</select>
			</div>

			<label for="inputLevel" class="col-sm-2 control-label">Level</label>
			<div class="col-sm-10 form-group">
				<select id="inputLevel" name="level" class="form-control" required>
					<option value="" selected disabled>Selectionner un niveau...</option>
					<option value="L2">License 2</option>
					<option value="L3">License 3</option>
					<option value="M1">Master 1</option>
					<option value="M2">Master 2</option>
					<option value="OTHER">Autre</option>
				</select>
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
				<input type="password" id="inputPassword2" name="confirm-password" class="form-control" placeholder="password again" required autofocus>
			</div>

			<div class="col-sm-12 form-group">
				<button class="btn btn-lg btn-primary center-block" type="submit" name="create-company">Create</button>
			</div>
		</form>
	</div>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root.admin.companies/companies-scripts.php');?>
	<script src="create.js"></script>

</body>
</html>