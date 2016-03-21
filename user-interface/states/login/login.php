<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/init.php');
require($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/autologin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Geostage</title>
	<link rel="stylesheet" href="/user-interface/vendors/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="login.css">
</head>

<body>
	<div class="container">
		<form class="form-signin" role="form" method="post">
			<h3 class="form-signin-heading">Connexion à Geostage</h3>
			<label for="inputUsername" class="sr-only">Nom d'utilisateur</label>
			<input type="text" id="inputUsername" name="username" class="form-control" placeholder="Nom d'utilisateur" required autofocus>
			<label for="inputPassword" class="sr-only">Mot de passe</label>
			<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
			<div class="checkbox">
				<label>
					<input type="checkbox" value="1" name="rememberme"> Se souvenir de moi
				</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Se connecter</button>
			<br/>
			<div>

				<?php require ('login-post.php');?>

			</div>
		</form>
	</div>

	<script src="/user-interface/vendors/jquery/dist/jquery.min.js"></script>
	<script src="/user-interface/vendors/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
