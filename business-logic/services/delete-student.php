<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-admin.php');?>

<?php
if(isset($_GET['ids'])){
	$ids = unserialize($_GET['ids']);
	foreach($ids as $id){
		$business->deleteStudent($id);
		$business->deleteUser($id);
	}
}
if(isset($_GET['id'])){
	$business->deleteStudent($_GET['id']);
	$business->deleteUser($_GET['id']);
}
?>