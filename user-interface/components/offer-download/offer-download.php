<div class="container">
	<div class="well well-sm">
		<label>Internship offers</label>
	</div>
	<?php

	$offers = array();
	if(isset($_COOKIE['auth'])){
		$token = $_COOKIE['auth'];
		$id;
		$info = $business->checkToken($token);
		if($info != FALSE){
			$user = $business->getUser($info['id_user']);
			$username = $user['username'];
			$usertype = $business->getUserType($username);
			if($usertype == 'company'){
				$id = $info['id_user'];
				$offers = $business->getInternshipOffers($id);
			}
			else{
				$id = $_GET['id'];
				$offers = $business->getInternshipOffers($id);
			}
		}
	}
	if($offers){
		foreach ($offers as $value){
			if(isset($_GET['id'])){
				echo('<div class="btn-group" role="group" aria-label="...">
					<button class="btn btn-default"><a href="/PIFE/data-access/offers/' . $_GET['id'] . '/' . $value['file_name'] . '">' . $value['file_name'] . '</a></button>
					<button class="btn btn-danger"><a href="/PIFE/business-logic/services/delete-offer.php?filename=' . $value['file_name'] . '&idcompany=' . $_GET['id'] . '">delete</a></button>
					</div>
					<br/>'
					);
			}
			else{
				echo('
					<div class="btn-group" role="group" aria-label="...">
					<button class="btn btn-default"><a href="/PIFE/data-access/offers/' . $info['id_user'] . '/' . $value['file_name'] . '">' . $value['file_name'] . '</a></button>
					<button class="btn btn-danger"><a href="/PIFE/business-logic/services/delete-offer.php?filename=' . $value['file_name'] . '&idcompany=' . $info['id_user'] . '">delete</a></button>
					</div>
					<br/>'
					);
			}
		}
		echo ('<br>');
	}
	?>
</div>
