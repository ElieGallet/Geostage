<?php
$uploadedStatus = 0;
if(isset($_POST['import'])){
	if(isset($_FILES['pstage'])) {
		if($_FILES['pstage']['error'] > 0) {
			echo ('Return Code: ' . $_FILES['pstage']['error'] . '<br/>'); 
		}
		else {
			if(file_exists($_FILES['pstage']['name'])){
				unlink($_FILES['pstage']['name']);
			}
			$storagename = 'pstage.xlsx';
			move_uploaded_file($_FILES['pstage']['tmp_name'], $storagename); 
			$uploadedStatus = 1;
			echo ('<div class="container">
				<div class="alert alert-success">
					<label>File successfuly uploaded</label>
				</div>
			</div>');
			if (substr($_FILES['pstage']['name'],-4) == '.xls' OR substr($_FILES['pstage']['name'],-4) == '.xlsx'){
				$business->treatExcelFile();
				$count = $business->excelFileTreatment->result;
				if($count['company'] == 0){
					echo ('<div class="container">
						<div class="alert alert-danger">
							<label>No company created</label>
						</div>
					</div>');
				}
				else if($count['company'] == 1){
					echo ('<div class="container">
						<div class="alert alert-success">
							<label>one company has been created</label>
						</div>
					</div>');
				}
				else{
					echo ('<div class="container">
						<div class="alert alert-success">
							<label>'.$count['company'].' companies have been created</label>
						</div>
					</div>');
				}
			}
			else{
				echo ('<div class="container">
					<div class="alert alert-danger">
					<label>File is not compatible</label>
					</div>
				</div>');
			}
		}	 
	}
	else {
		echo('No file selected <br/>');
	}
}
?>