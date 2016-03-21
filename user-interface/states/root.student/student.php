<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/init.php');?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/auth-student.php');?>

<!doctype html>
<html>
<head>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root/root-head.php');?>
	<link rel="stylesheet" href="/user-interface/components/map-frame/css/map-frame.css"/>

</head>
<body>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root/root.php');?>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/components/student-navbar/student-navbar.html');?>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/components/map-frame/map-frame.php');?>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/user-interface/states/root/root-scripts.php');?>
	<script src="/user-interface/components/map-frame/js/map-frame.js"></script>

</body>
</html>
