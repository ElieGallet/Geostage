<?php
if(isset($_COOKIE['auth'])){
	$token = $_COOKIE['auth'];
	$info = $business->checkToken($token);
	if($info != FALSE){
		$user = $business->getUser($info['id_user']);
		$username = $user['username'];
		$usertype = $business->getUserType($username);
		if($usertype == 'company' OR $usertype == 'admin'){
		}
		else{
			echo('<script>console.log("not authorized");</script>');
			header('Location: /user-interface/states/login/login.php');
			exit();
		}
	}
	else{
		echo('<script>console.log("wrong token");</script>');
		header('Location: /user-interface/states/login/login.php');
		exit();
	}
}
else{
	echo('<script>console.log("no token found");</script>');
	header('Location: /user-interface/states/login/login.php');
	exit();
}
?>