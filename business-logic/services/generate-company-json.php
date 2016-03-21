<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-admin.php');?>

<?php
$result = $business->getCompanyUsers();
echo (json_encode($result));
?>