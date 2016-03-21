<?php
if(isset($_POST['generate'])){
	$data = $business->getCompanies();
	if($data){
		$encoded_data = json_encode($data);
		$fileJSON = $_SERVER['DOCUMENT_ROOT'] . '/PIFE/data-access/json/company.json';
		file_put_contents($fileJSON, $encoded_data);
		require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/create-company-geojson.php');
	}
}
?>