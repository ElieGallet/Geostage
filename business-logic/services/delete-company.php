<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-admin.php');?>

<?php
if(isset($_GET['id'])){
	$business->deleteCompany($_GET['id']);
	$business->deleteUser($_GET['id']);
}
if(isset($_GET['ids'])){
	$business->deleteCompanies($_GET['ids']);
	$business->deleteUsers($_GET['ids']);
}
?>