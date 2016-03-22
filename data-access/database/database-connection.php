<?php
class dbconnection {

	private $bd;

	function dbconnection(){
		// $host = "eu-cdbr-west-01.cleardb.com";
	 	//$database = "heroku_969d8d13a65871b";
	 	//$username = "bf854aa012c4de";
	 	//$password = "ea5ec6f7";
		$host = "eu-cdbr-west-01.cleardb.com";
		$database = "heroku_1d93613635eda50";
		$username = "b93239e632a5e1";
		$password = "e8f293c0";

		$this->bd = new PDO('mysql:host='.$host.';dbname='.$database,$username,$password);  

		return TRUE;
	}

	function isCorrectPassword($username, $password){
		$sql = "SELECT password FROM user WHERE username = '$username'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();

		if(!$dbarray){
			return FALSE;
		}      
		else{
			if($password == $dbarray['password']){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}  
	}

	function doesInternExist($lastName, $firstName){
		$sql = "SELECT id FROM intern WHERE first_name = '$firstName' AND last_name = '$lastName'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();

		if(!$dbarray){
			return FALSE;
		}      
		else{
			return TRUE;
		}
	}

	function doesStudentExist($lastName, $firstName){
		$sql = "SELECT * FROM student WHERE first_name = '$firstName' AND last_name = '$lastName'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();

		if(!$dbarray){
			return FALSE;
		}      
		else{
			return TRUE;
		}
	}

	function doesCompanyExist($siret){
		$sql = "SELECT siret FROM company WHERE siret = '$siret'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();

		if(!$dbarray){
			return FALSE;
		}      
		else{
			return TRUE;
		}  
	}

	function doesUsernameExist($username){
		$sql = "SELECT username FROM user WHERE username = '$username'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();

		if(!$dbarray){
			return FALSE;
		}      
		else{
			return TRUE;
		}  
	}

	function doesInternshipExist($internId, $companyId){
		$sql = "SELECT id FROM internship WHERE id_intern = '$internId' AND id_company = '$companyId'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();

		if(!$dbarray){
			return FALSE;
		}      
		else{
			return TRUE;
		}  
	}

	function getUserType($username){
		$userId = $this->getUserId($username);

		$sql_student = "SELECT id FROM student WHERE id = $userId";
		$result_student = $this->bd->query($sql_student);
		$dbarray_student = $result_student->fetch();

		if($dbarray_student){
			return "student";
		}
		else{
			$sql_company = "SELECT id FROM company WHERE id = $userId";
			$result_company = $this->bd->query($sql_company);
			$dbarray_company = $result_company->fetch();
			if($dbarray_company){
				return "company";
			}
			else{
				$sql_admin = "SELECT id FROM administrator WHERE id = $userId";
				$result_admin = $this->bd->query($sql_admin);
				$dbarray_admin = $result_admin->fetch();
				if($dbarray_admin){
					return "admin";
				}
				else{
					return "unidentified user";
				}
			}
		}
	}

	function getUserId($username){
		$sql = "SELECT id FROM user WHERE username = '$username'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();
		$userId = $dbarray['id'];

		return $userId;
	}

	function getInternId($firstName, $lastName){
		$sql = "SELECT id FROM intern WHERE firstName = '$firstName' AND lastName = '$lastName'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();
		$internId = $dbarray['id'];

		return $internId;
	}

	function getCompanyId($siret){
		$sql = "SELECT id FROM company WHERE siret = '$siret'";
		$result = $this->bd->query($sql);
		$dbarray = $result->fetch();
		$companyId = $dbarray['id'];

		return $companyId;
	}

	function createUser($username, $password){
		$sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

		if ($this->bd->query($sql) == TRUE){
			return TRUE;
		} 
		else {
			return FALSE;
		}
	}

	function createToken($idUser, $value, $date, $duration){
		$time = time();
		$sql = "INSERT INTO token (value, id_user, date, duration) VALUES ('$value', '$idUser', '$date', '$duration')";

		if ($this->bd->query($sql) == TRUE) {
			return true;
		} 
		else {
			return false;
		}
	}

	function checkToken($value){
		$sql = "SELECT * FROM token WHERE value='$value'";    
		$req = $this->bd->query($sql);    
		if ($req->rowCount() > 0) {
			$row = $req->fetch();
			return $row;
		}
		else{
			return FALSE;
		}
	}

	function createStudent($id, $firstName, $lastName, $graduatingYear, $course, $diploma){
		$sql = "INSERT INTO student (id, first_name, last_name, graduating_year, course, diploma) VALUES ('$id', '$firstName', '$lastName', '$graduatingYear', '$course', '$diploma')";

		if ($this->bd->query($sql) == TRUE) {
			return TRUE;
		} 
		else{
			return FALSE;
		}
	}

	function createCompany($id, $siret, $sector, $level, $name, $description, $phone, $email, $tutor, $address, $street, $cedex, $postalCode, $city, $country, $website){
		$sql = "INSERT INTO company (id, siret, sector, level, name, description, phone, email, tutor, address, street, cedex, postal_code, city, country, website)
		VALUES ('$id', '$siret', '$sector', '$level', '$name', '$description', '$phone', '$email', '$tutor', '$address', '$street', '$cedex', '$postalCode', '$city', '$country', '$website')";
		if($this->bd->query($sql) == TRUE){
			return TRUE;
		} 
		else{
			return FALSE;
		}
	}

	function createIntern($firstName, $lastName){
		$sql = "INSERT INTO intern (first_name, last_name) VALUES ('$firstName', '$lastName')";

		if ($this->bd->query($sql) == TRUE) {
			return TRUE;
		} 
		else{
			return FALSE;
		}
	}

	function createInternship($company, $intern, $startDate, $endDate, $academicYear){
		$sql = "INSERT INTO internship (id_company, id_intern, start_date, end_date, academic_year) VALUES ('$company', '$intern', '$startDate', '$endDate', '$academicYear')";

		if ($this->bd->query($sql) == TRUE) {
			return TRUE;
		} 
		else{
			return FALSE;
		}
	}

	function createInternshipOffer($idCompany, $fileName){
		$sql = "INSERT INTO internship_offer (id_company, file_name) VALUES ('$idCompany', '$fileName')";

		if ($this->bd->query($sql) == TRUE) {
			return TRUE;
		} 
		else {
			return FALSE;
		}
	}

	function getUsers(){
		$sql = 'SELECT * FROM user';    
		$req = $this->bd->query($sql);

		if ($req->rowCount() > 0) {
			$result = array();
			while($row = $req->fetch()){
				array_push($result, $row);
			}
			return $result;
		}
		else{
			return FALSE;
		}
	}

	function getStudents(){
		$sql = 'SELECT * FROM student';    
		$req = $this->bd->query($sql);

		if ($req->rowCount() > 0){
			$result = array();
			while($row = $req->fetch()){
				array_push($result, $row);
			}
			return $result;
		}
		else{
			return FALSE;
		}
	}

	function getCompanies(){
		$sql = 'SELECT * FROM company';    
		$req = $this->bd->query($sql);

		if ($req->rowCount() > 0){
			$result = array();
			while($row = $req->fetch()){
				array_push($result, $row);
			}
			return $result;
		}
		else{
			return FALSE;
		}
	}

	function getCompanyUsers(){
		$sql = 'SELECT * FROM user, company WHERE user.id=company.id';

		$result = $this->bd->query($sql)->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	function getStudentUsers(){
		$sql = 'SELECT * FROM user, student WHERE user.id=student.id';

		$result = $this->bd->query($sql)->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	function getInternshipOffers($companyId){
		$sql = "SELECT * FROM internship_offer WHERE id_company = '$companyId'";    
		$req = $this->bd->query($sql);

		if ($req->rowCount() > 0){
			$result = array();
			while($row = $req->fetch()){
				array_push($result, $row);
			}
			return $result;
		}
		else{
			return FALSE;
		}
	}

	function getUser($userId){
		$sql = "SELECT * FROM user WHERE id = '$userId'";    
		$req = $this->bd->query($sql);

		if ($req->rowCount() > 0){
			$row = $req->fetch();
			return $row;
		}
		else{
			return FALSE;
		}
	}

	function getStudent($studentId){
		$sql = "SELECT * FROM student WHERE id = '$studentId'";
		$req = $this->bd->query($sql);

		if ($req->rowCount() > 0) {
			$row = $req->fetch();
			return $row;
		}
		else{
			return FALSE;
		}
	}

	function getCompany($companyId){
		$sql = "SELECT * FROM company WHERE id = '$companyId'";    
		$req = $this->bd->query($sql);

		if ($req->rowCount() > 0) {
			$row = $req->fetch();
			return $row;
		}
		else{
			return FALSE;
		}
	}

	function updateUser($userId, $username, $password){
		$sql = "UPDATE user SET username = '$username', password = '$password' WHERE id = '$userId'";
		$req = $this->bd->query($sql);

		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function updateUserPassword($userId, $password){
		$sql = "UPDATE user SET password = '$password' WHERE id = '$userId'";
		$req = $this->bd->query($sql);

		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function updateUsername($userId, $username){
		$sql = "UPDATE user SET username = '$username' WHERE id = '$userId'";
		$req = $this->bd->query($sql);

		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function updateStudent($id, $firstName, $lastName){
		$sql = "UPDATE student SET firstName = '$firstName' , lastName = '$lastName' WHERE id = '$id' ";
		$req = $this->bd->query($sql);

		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function updateCompany($companyId, $siret, $sector, $level, $name, $description, $phone, $email, $tutor, $address, $street, $cedex, $postalCode, $city, $country, $website){
		$sql = "UPDATE company SET siret = '$siret', sector = '$sector', level = '$level' , name = '$name', description = '$description', phone = '$phone', email = '$email', tutor = '$tutor', address = '$address', street = '$street', cedex = '$cedex', postal_code = '$postalCode', city = '$city', country = '$country',  website = '$website' WHERE id = '$companyId' ";
		$req = $this->bd->query($sql);

		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function deleteUser($userId){
		$sql = "DELETE FROM user WHERE id = '$companyId'";
		$req = $this->bd->query($sql);

		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function deleteStudent($studentId){
		$sql = "DELETE FROM student WHERE id = '$studentId'";
		$req = $this->bd->query($sql);
		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function deleteCompany($companyId){
		$sql = "DELETE FROM company WHERE id = '$companyId'";
		$this->bd->query("SET foreign_key_checks = 0");
		$req = $this->bd->query($sql);
		$this->bd->query("SET foreign_key_checks = 1");
		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function deleteCompanyInternships($companyId){
		$sql = "DELETE FROM internship WHERE id_company='$companyId'";
		$req = $this->bd->query($sql);
		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function deleteInternshipOffer($companyId, $fileName){
		$sql = "DELETE FROM internship_offer WHERE file_name='$fileName' AND id_company = '$companyId'";
		$req = $this->bd->query($sql);
		if ($req){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>