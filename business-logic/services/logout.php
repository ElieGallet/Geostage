<?php
	setcookie('auth', $token, time() - 3600, '/');
	header('Location: /user-interface/states/login/login.php');
	exit();
?>