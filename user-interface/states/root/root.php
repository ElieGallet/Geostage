<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/business.php');

if(isset($_COOKIE['auth'])){
	$token = $_COOKIE['auth'];
	$info = $business->checkToken($token);
	if($info == FALSE){
		header('Location: ' . '/PIFE/user-interface/states/root.login/login.php');
		exit();
	}
}
else{
	header('Location: ' . '/PIFE/user-interface/states/root.login/login.php');
	exit();
}
?>