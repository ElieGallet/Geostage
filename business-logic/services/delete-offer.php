<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-company.php');
// WARNING companies can delete other companies offers
?> 

<?php
	if(isset($_GET['filename'])){
		$result = $business->deleteInternshipOffer($_GET['idcompany'], $_GET['filename']);
		//unlink('/PIFE/data-access/offers/' . $companyId . '/' . $link);
		unlink($_SERVER['DOCUMENT_ROOT'] . '/PIFE/data-access/offers/' . $_GET['idcompany'] . '/' . $_GET['filename']);
	}
	if($usertype == 'admin'){
		header('Location: /PIFE/user-interface/states/root.admin.companies.update/update.php?id='.$_GET['idcompany']);
		exit();
	}
	else if($usertype == 'company'){
		header('Location: /PIFE/user-interface/states/root.company/company.php');
		exit();
	}
?>