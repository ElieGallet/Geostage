<div class="container">
	<div class="well well-sm"><label>Import PDF</label></div>
	<form class="form-horizontal form-group" role="form" method="post" enctype="multipart/form-data">
		<label for="inputFile" class="col-sm-2 control-label">Browse PDF files</label>
		<div class="col-sm-10 form-group">
			<input type="file" name="internshipOffer" class="form-control" id="file" accept=".pdf" required/>
		</div>
		<div class="col-sm-12 form-group">
			<button class="btn btn-lg btn-success center-block" type="submit" name="importPDF">Import</button>
		</div>
	</form>
</div>

<?php
$id;
if(isset($_COOKIE['auth'])){
	$token = $_COOKIE['auth'];
	$info = $business->checkToken($token);
	if($info != FALSE){
		$user = $business->getUser($info['id_user']);
		$username = $user['username'];
		$usertype = $business->getUserType($username);
		if($usertype == 'company'){
			$id = $info['id_user'];
		}
		else{
			$id = $_GET['id'];
		}
	}
}

$uploadedStatus = 0;
if(isset($_POST['importPDF'])){
	if(isset($_FILES['internshipOffer'])){ 
		if($_FILES['internshipOffer']['error'] > 0){ 
			echo 'Return Code: '.$_FILES['internshipOffer']['error'].'<br />'; 
		} 
		else{ 
			if(file_exists($_FILES['internshipOffer']['name'])){
				unlink($_FILES['internshipOffer']['name']);
			}
			$fileName = basename($_FILES['internshipOffer']['name']);
			$fileName = str_replace("'", "''", $fileName);
			$fileName = str_replace("é", "e", $fileName);
			$fileName = str_replace(" ", "", $fileName);
			$path = $_SERVER['DOCUMENT_ROOT'] . '/data-access/offers/'. $id . '/';
			if(!is_dir($path)){
				mkdir($path);
			}
			$storagename = $path . $fileName;
			move_uploaded_file($_FILES['internshipOffer']['tmp_name'], $storagename); 
			$uploadedStatus = 1;
			echo ('<div class="container">
				<div class="alert alert-success">
					<label>File successfully uploaded</label>
				</div>
			</div>');
			if (substr($_FILES['internshipOffer']['name'], -4) == '.pdf'){
				$business->createInternshipOffer($id, $fileName);
			}
			else{
				echo ('<div class="container">
					<div class="alert alert-danger">
						<label>File not compatible</label>
					</div>
				</div>');
			}
		}
	}
	else{ 
		echo ('No file selected <br/>');
	}
}
?>