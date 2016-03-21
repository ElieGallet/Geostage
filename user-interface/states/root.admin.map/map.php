<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-admin.php');?>

<!doctype html>
<html>
<head>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.companies/companies-head.php');?>
	<link rel="stylesheet" href="/PIFE/user-interface/components/map-frame/css/map-frame.css"/>
	
</head>
<body>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.companies/companies.php');?>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/components/update-map/update-map.php');?>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/components/map-frame/map-frame.php');?>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.companies/companies-scripts.php');?>
	<script src="/PIFE/user-interface/components/map-frame/js/map-frame.js"></script>

</body>
</html>
