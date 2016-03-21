<?php
if (isset($_COOKIE['auth'])){
	$token = $_COOKIE['auth'];
	$info = $business->checkToken($token);
	if ($info != FALSE){
		$user = $business->getUser($info['id_user']);
		$username = $user['username'];
		$usertype = $business->getUserType($username);
		if ($usertype == 'student'){
			header('Location: /PIFE/user-interface/states/root.student/student.php');
			exit();
		}
		else if ($usertype == 'company'){
			header('Location: /PIFE/user-interface/states/root.company/company.php?company='.$username);
			exit();
		}
		else if ($usertype == 'admin'){
			header('Location: /PIFE/user-interface/states/root.admin.companies.list/list.php');
			exit();
		}
	}
}
?>