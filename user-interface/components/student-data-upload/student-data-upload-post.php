<?php
$uploadedStatus = 0;
if(isset($_POST['import'])){
	if(isset($_FILES['students'])) {
		if($_FILES['students']['error'] > 0) {
			echo ('Return Code: ' . $_FILES['students']['error'] . '<br/>'); 
		}
		else {
			if(file_exists($_FILES['students']['name'])){
				unlink($_FILES['students']['name']);
			}
			$storagename = 'students.xlsx';
			move_uploaded_file($_FILES['students']['tmp_name'], $storagename); 
			$uploadedStatus = 1;
			echo ('<div class="container">
				<div class="alert alert-success">
					<label>File successfully uploaded</label>
				</div>
			</div>');
			if (substr($_FILES['students']['name'],-4) == '.xls' OR substr($_FILES['students']['name'],-4) == '.xlsx'){
				$business->treatStudentExcelFile();
				$count = $business->studentExcelFileTreatment->result;
				if($count['students'] == 0){
					echo ('<div class="container">
						<div class="alert alert-danger">
							<label>No student created</label>
						</div>
					</div>');
				}
				else if($count['students'] == 1){
					echo ('<div class="container">
						<div class="alert alert-success">
							<label>one student has been created</label>
						</div>
					</div>');
				}
				else{
					echo ('<div class="container">
						<div class="alert alert-success">
							<label>'.$count['students'].' students have been created</label>
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