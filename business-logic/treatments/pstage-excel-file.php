<?php
set_include_path(get_include_path().PATH_SEPARATOR.'Classes/');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/business-logic/libraries/PHPExcel.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/business-logic/libraries/PHPExcel/IOFactory.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/business-logic/business.php');

class pstageExcelFileTreatment{

	private $business;
	private $objPHPExcel;
	public $result;

	function pstageExcelFileTreatment(){
		$this->business = new business();
		$inputFileName = 'pstage.xlsx';
		try {
			$this->objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		}
		catch(Exception $e){
			die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		$this->result = $this->generateTables();
	}

	function generateTables(){
		//$this->generateInternTable;
		$result['company'] = $this->generateCompanyTable();
		//$this->generateInternshipTable();
		return $result;
	}

	function generateInternTable(){
		$columnLastName = $this->getColumnName("Nom étudiant");
		$columnFirstName = $this->getColumnName("Prénom étudiant");

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

				if(!$this->business->doesInternExist($lastName, $firstName)){
					$this->business->createIntern($firstName,$lastName);
				}
			}
		}
	}

	function generateCompanyTable(){
		$count = 0;
		$columnSiret = $this->getColumnName("Siret");
		$columnSector = $this->getColumnName("Thématique");
		$columnLevel = $this->getColumnName("Code Etape");
		$columnName = $this->getColumnName("Nom Etablissement d'accueil");
		$columnDescription = $this->getColumnName("Type de Structure");
		$columnTelNum = $this->getColumnName("Téléphone ");
		$columnEmail = $this->getColumnName("Mail Tuteur professionnel");
		$columnTutor = $this->getColumnName("Nom Tuteur Professionnel");
		$columnAddress = $this->getColumnName("Adresse Residence");
		$columnStreet = $this->getColumnName("Adresse Voie");
		$columnCedex = $this->getColumnName("Adresse lib cedex");
		$columnPostalCode = $this->getColumnName("Code Postal");
		$columnCity = $this->getColumnName("Etablissement d'Accueil - Commune");
		$columnCountry = $this->getColumnName("Pays");
		$columnWebsite = $this->getColumnName("SiteWeb");

		$worksheet = $this->objPHPExcel->getActiveSheet();

		foreach($worksheet->getRowIterator() as $row){
			$rowIndex = $row->getRowIndex();
			if($rowIndex !== 1){

				//fetching siret
				$cellSiret = $worksheet->getCell($columnSiret.$rowIndex);
				$siret = $cellSiret->getCalculatedValue();

				//fetching sector
				$cellSector = $worksheet->getCell($columnSector.$rowIndex);
				$sector = $cellSector->getCalculatedValue();
				if ($sector !== 'DS' AND $sector !== 'O' AND $sector !== 'DP' AND $sector !== 'DM' AND $sector !== 'V' AND $sector !== 'DC' AND $sector !== 'AIS'){
					$sector = 'OTHER';
				} 

				//fetching level
				$cellLevel = $worksheet->getCell($columnLevel.$rowIndex);
				$level = $cellLevel->getCalculatedValue();
				$level = substr($level,1,2);
				if ($level !== 'L2' AND $level !== 'L3' AND $level !== 'M1' AND $level !== 'M2'){
					$level = 'OTHER';
				} 

				//fetching name
				$cellName = $worksheet->getCell($columnName.$rowIndex);
				$name = $cellName->getCalculatedValue();
				$name = str_replace("'", "''", $name);

				//fetching description
				$cellDescription = $worksheet->getCell($columnDescription.$rowIndex);
				$description = $cellDescription->getCalculatedValue();
				$description = str_replace("'", "''", $description);

				//fetching tel number
				$cellTelNum = $worksheet->getCell($columnTelNum.$rowIndex);
				$telNumber = $cellTelNum->getCalculatedValue();

				//fetching email
				$cellEmail = $worksheet->getCell($columnEmail.$rowIndex);
				$email = $cellEmail->getCalculatedValue();

				//fetching tutor
				$cellTutor = $worksheet->getCell($columnTutor.$rowIndex);
				$tutor = $cellTutor->getCalculatedValue();

				//fetching address
				$cellAddress = $worksheet->getCell($columnAddress.$rowIndex);
				$address = $cellAddress->getCalculatedValue();
				$address = str_replace("'", "''", $address);

				//fetching address street
				$cellStreet = $worksheet->getCell($columnStreet.$rowIndex);
				$addressStreet = $cellStreet->getCalculatedValue();
				$addressStreet = str_replace("'", "''", $addressStreet);

				//fetching address cedex
				$cellCedex = $worksheet->getCell($columnCedex.$rowIndex);
				$addressCedex = $cellCedex->getCalculatedValue();
				$addressCedex = str_replace("'", "''", $addressCedex);

				//fetching address postal code
				$cellPostalCode = $worksheet->getCell($columnPostalCode.$rowIndex);
				$addressPostalCode = $cellPostalCode->getCalculatedValue();
				$addressPostalCode = str_replace("'", "''", $addressPostalCode);

				//fetching address city
				$cellCity = $worksheet->getCell($columnCity.$rowIndex);
				$addressCity = $cellCity->getCalculatedValue();
				$addressCity = str_replace("'", "''", $addressCity);

				//fetching address country
				$cellCountry = $worksheet->getCell($columnCountry.$rowIndex);
				$addressCountry = $cellCountry->getCalculatedValue();
				$addressCountry = str_replace("'", "''", $addressCountry);

				//fetching websites
				$cellWebsite = $worksheet->getCell($columnWebsite.$rowIndex);
				$website = $cellWebsite->getCalculatedValue();
				
				//create user and fetch its id
				$random =  substr(md5(uniqid(rand(), true)), 0, 6);
				$username = "company".$random;
				$this->business->createUser($username,"");
				$id = $this->business->getUserId($username);

				if(!empty($siret)){
					if(!$this->business->doesCompanyExist($siret)){
						$result = $this->business->createCompany($id, $siret, $sector, $level, $name, $description, $telNumber, $email, $tutor, $address, $addressStreet, $addressCedex, $addressPostalCode, $addressCity, $addressCountry, $website);
						if ($result){
							$count = $count + 1;
						}
					}
				}
			}
		}
		return $count;
	}

	function generateInternshipTable(){
		$columnStartDate = $this->getColumnName("Date Début Stage");
		$columnEndDate = $this->getColumnName("Date Fin Stage");
		$columnAcademinYear = $this->getColumnName("Année Universitaire");
		$columnInternFirstName = $this->getColumnName("Prénom étudiant");
		$columnInternLastName = $this->getColumnName("Nom étudiant");
		$columnCompany = $this->getColumnName("Siret");

		$worksheet = $this->objPHPExcel->getActiveSheet();

		foreach($worksheet->getRowIterator() as $row){
			$rowIndex = $row->getRowIndex();
			if($rowIndex !== 1){
				//fetching start dates
				$cellStartDate = $worksheet->getCell($columnStartDate.$rowIndex);
				$startDate = $cellStartDate->getCalculatedValue();
				$tmp = explode("/", $startDate);
				$startDate = $tmp[2]."-".$tmp[1]."-".$tmp[0];

				//fetching end dates
				$cellEndDate = $worksheet->getCell($columnEndDate.$rowIndex);
				$endDate = $cellEndDate->getCalculatedValue();
				$tmp = explode("/", $endDate);
				$endDate = $tmp[2]."-".$tmp[1]."-".$tmp[0];

				//fetching academic years
				$cellAcademicYear = $worksheet->getCell($columnAcademinYear.$rowIndex);
				$academicYear = $cellAcademicYear->getCalculatedValue();

				//fetching interns first names
				$cellInternFirstName = $worksheet->getCell($columnInternFirstName.$rowIndex);
				$internFirstName = $cellInternFirstName->getCalculatedValue();

				//fetching interns last names
				$cellInternLastName = $worksheet->getCell($columnInternLastName.$rowIndex);
				$internLastName = $cellInternLastName->getCalculatedValue();

				//fetching companies
				$cellCompany = $worksheet->getCell($columnCompany.$rowIndex);
				$company = $cellCompany->getCalculatedValue();

				//fetching id from database
				$internId = $this->business->getinternId($internFirstName, $internLastName);

				if(!empty($company)){
					$companyID = $this->business->getCompanyId($company);
					if(!$this->business->doesInternshipExist($internId, $companyID))
					{
						$this->business->createInternship($startDate, $endDate, $academicYear, $internId, $companyID);
					}
				}
			}
		}
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