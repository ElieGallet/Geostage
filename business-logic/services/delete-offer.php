<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/business-logic/includes/auth-company.php');
// WARNING companies can delete other companies offers
?> 

<?php
	if(isset($_GET['filename'])){
		$result = $business->deleteInternshipOffer($_GET['idcompany'], $_GET['filename']);
		//unlink('/data-access/offers/' . $companyId . '/' . $link);
		unlink($_SERVER['DOCUMENT_ROOT'] . '/data-access/offers/' . $_GET['idcompany'] . '/' . $_GET['filename']);
	}
	if($usertype == 'admin'){
		header('Location: /user-interface/states/root.admin.companies.update/update.php?id='.$_GET['idcompany']);
		exit();
	}
	else if($usertype == 'company'){
		header('Location: /user-interface/states/root.company/company.php');
		exit();
	}
?>