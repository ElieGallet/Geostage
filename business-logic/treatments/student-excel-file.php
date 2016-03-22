<?php
set_include_path(get_include_path().PATH_SEPARATOR.'Classes/');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/business-logic/libraries/PHPExcel.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/business-logic/libraries/PHPExcel/IOFactory.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/business-logic/business.php');

class studentExcelFileTreatment{

	private $business;
	private $objPHPExcel;
	public $result;

	function studentExcelFileTreatment(){
		$this->business = new business();
		$inputFileName = 'students.xlsx';
		try {
			$this->objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		}
		catch(Exception $e){
			die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		$this->result = $this->generateTables();	
	}

	function generateTables(){
		$result['students'] = $this->generateStudentTable();
		return $result;
	}

	function generateStudentTable(){
		$count = 0;
		$columnLastName = $this->getColumnName("NOM");
		$columnFirstName = $this->getColumnName("PRENOM");
		$columnGraduatingYear = $this->getColumnName("PROMO");
		$columnCourse = $this->getColumnName("PARCOURS");
		$columnDiploma = $this->getColumnName("DIPLOME");

		$worksheet = $this->objPHPExcel->getActiveSheet();

		foreach($worksheet->getRowIterator() as $row){
			$rowIndex = $row->getRowIndex();
			if($rowIndex !== 1){

				//fetching last names
				$cellLastName = $worksheet->getCell($columnLastName.$rowIndex);
				$lastName = $cellLastName->getCalculatedValue();

				//fetching first names
				$cellFirstName = $worksheet->getCell($columnFirstName.$rowIndex);
				$firstName = $cellFirstName->getCalculatedValue();

				//fetching graduating years
				$cellGraduatingYear = $worksheet->getCell($columnGraduatingYear.$rowIndex);
				$graduatingYear = $cellGraduatingYear->getCalculatedValue();

				//fetching courses
				$cellCourse = $worksheet->getCell($columnCourse.$rowIndex);
				$course = $cellCourse->getCalculatedValue();

				//fetching diplomas
				$cellDiploma = $worksheet->getCell($columnDiploma.$rowIndex);
				$diploma = $cellDiploma->getCalculatedValue();

				$random =  substr(md5(uniqid(rand(), true)), 0, 6);
				$username = "student".$random;
				if(!empty($firstName) AND !empty($lastName)){
					if(!$this->business->doesStudentExist($lastName, $firstName)){
						$this->business->createUser($username,"");
						$id = $this->business->getUserId($username);
						echo($id. ' ' . $firstName. ' ' . $lastName . ' ' . $graduatingYear . ' ' . $course . ' ' . $diploma);
						$result = $this->business->createStudent($id, $firstName, $lastName, $graduatingYear, $course, $diploma);
						if ($result){
							$count = $count + 1;
						}
					}
				}
			}
		}
		return $count;
	}

	function getColumnName($cellValue){
		$row = $this->objPHPExcel->getActiveSheet()->getRowIterator("1")->current();
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false);
		$i=0;
		foreach ($cellIterator as $cell){
			$cell = $cell->getValue();
			if(strcmp(utf8_encode($cell), utf8_encode($cellValue)) !== 0){
				$i++;
			}
			else{
				break;
			}
		}
		$columnIndex = $i;
		$adjustment = -1; // columnIndexFromString() will return a 1 for column A, but stringFromColumnIndex expects a 0 to correspond to column A
		$adjustedColumnIndex = $columnIndex + $adjustment;
		$columnName = PHPExcel_Cell::stringFromColumnIndex($columnIndex);

		return $columnName;
	}
}
?>