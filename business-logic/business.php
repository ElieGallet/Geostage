<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/data-access/database/database-connection.php');
require_once('treatments/excel-file.php');

class business{
	
	private $dbconnection;
	public $excelFileTreatment;

	function business(){
		$this->dbconnection = new dbconnection();
	}

	function encryptPassword($password){
		return sha1($password);
	}

	function generateToken(){
		return sha1(rand().microtime());
	}

	function createToken($username, $token, $date, $duration){
		$id = $this->dbconnection->getUserId($username);
		return $this->dbconnection->createToken($id, $token, $date, $duration);
	}

	function checkToken($token){
		return $this->dbconnection->checkToken($token);
	}

	function isCorrectPassword($userId, $password){
		return $this->dbconnection->isCorrectPassword($userId,  $this->encryptPassword($password));
	}

	function doesInternExist($lastName, $firstName){
		return $this->dbconnection->doesInternExist($lastName, $firstName);
	}

	function doesCompanyExist($siret){
		return $this->dbconnection->doesCompanyExist($siret);
	}

	function doesUsernameExist($username){
		return $this->dbconnection->doesUsernameExist($username);
	}

	function doesInternshipExist($internId, $companyId){
		return $this->dbconnection->doesInternshipExist($internId, $companyId);
	}

	function getUserType($username){
		return $this->dbconnection->getUserType($username);
	}

	function getUserId($username){
		return $this->dbconnection->getUserId($username);
	}

	function getInternId($firstName, $lastName){
		return $this->dbconnection->getInternId($firstName,$lastName);
	}

	function getCompanyId($siret){
		return $this->dbconnection->getCompanyId($siret);
	}

	function createUser($username, $password){
		return $this->dbconnection->createUser($username, $this->encryptPassword($password));
	}

	function createStudent($id, $firstName, $lastName){
		return $this->dbconnection->createStudent($id, $firstName, $lastName);
	}

	function createCompany($id, $siret, $sector, $level, $name, $description, $phone, $email, $tutor, $address, $street, $cedex, $postalCode, $city, $country, $website){
		return $this->dbconnection->createCompany($id, $siret, $sector, $level, $name, $description, $phone, $email, $tutor, $address, $street, $cedex, $postalCode, $city, $country, $website);
	}

	function createIntern($firstName, $lastName){
		return $this->dbconnection->createIntern($firstName, $lastName);
	}

	function createInternship($startDate, $endDate, $academicYear, $intern, $company){
		return $this->dbconnection->createInternship($startDate, $endDate, $academicYear, $intern, $company);
	}

	function createInternshipOffer($companyId, $link){
		return $this->dbconnection->createInternshipOffer($companyId, $link);
	}

	function getUsers(){
		return $this->dbconnection->getUsers();
	}

	function getStudents(){
		return $this->dbconnection->getStudents();
	}

	function getCompanies(){
		return $this->dbconnection->getCompanies();
	}

	function getInternshipOffers($companyId){
		return $this->dbconnection->getInternshipOffers($companyId);
	}

	function getUser($userId){
		return $this->dbconnection->getUser($userId);
	}

	function getStudent($studentId){
		return $this->dbconnection->getStudent($studentId);
	}

	function getCompany($companyId){
		return $this->dbconnection->getCompany($companyId);
	}

	function getStudentUsers(){
		return $this->dbconnection->getStudentUsers();
	}

	function getCompanyUsers(){
		return $this->dbconnection->getCompanyUsers();
	}

	function updateUser($userId, $username, $password){
		return $this->dbconnection->updateUser($userId, $username,  $this->encryptPassword($password));
	}

	function updateUserPassword($userId, $password){
		return $this->dbconnection->updateUserPassword($userId,  $this->encryptPassword($password));
	}

	function updateUsername($userId, $username){
		return $this->dbconnection->updateUsername($userId, $username);
	}

	function updateStudent($userId, $firstName, $lastName){
		return $this->dbconnection->updateStudent($userId, $firstName, $lastName);
	}

	function updateCompany($id, $siret, $sector, $level, $name, $description, $phone, $email, $tutor, $address, $street, $cedex, $postalCode, $city, $country, $website){
		return $this->dbconnection->updateCompany($id, $siret, $sector, $level, $name, $description, $phone, $email, $tutor, $address, $street, $cedex, $postalCode, $city, $country, $website);
	}

	function deleteUser($userId){
		return $this->dbconnection->deleteUser($userId);
	}

	function deleteStudent($studentId){
		return $this->dbconnection->deleteStudent($studentId);
	}

	function deleteCompany($companyId){
		return $this->dbconnection->deleteCompany($companyId);
	}

	function deleteCompanyInternships($companyId){
		return $this->dbconnection->deleteCompanyInternships($companyId);
	}

	function deleteInternshipOffer($companyId, $link){
		return $this->dbconnection->deleteInternshipOffer($companyId, $link);
	}

	function treatExcelFile(){
		$this->excelFileTreatment = new excelFileTreatment();
	}
}
?>