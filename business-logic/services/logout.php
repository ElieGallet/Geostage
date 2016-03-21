<?php
	setcookie('auth', $token, time() - 3600, '/');
	header('Location: /PIFE/user-interface/states/login/login.php');
	exit();
?>