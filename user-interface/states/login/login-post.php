<?php
			if(isset($_POST['login']) && !empty($_POST['username']) 
				&& !empty($_POST['password'])) {
				
				if($business->isCorrectPassword($_POST['username'], $_POST['password'])){
					$duration = 86400 * 30;
					$token = $business->generateToken();
					$business->createToken($_POST['username'], $token, time(), $duration);
					if(isset($_POST['rememberme'])){
						setcookie('auth', $token, time() + $duration, '/');
					}
					else{
						setcookie('auth', $token, 0, '/');
					}
					
					echo '
					<div class="alert alert-success">
						<label>Valid use name and password</label>
					</div>
					';
					if($business->getUserType($_POST['username']) == "student"){
						header('Location: .\..\root.student\student.php');
						exit();
					}
					else if($business->getUserType($_POST['username']) == "company"){
						header('Location: .\..\root.company\company.php?company='.$_POST['username']);
						exit();
					}
					else if($business->getUserType($_POST['username']) == "admin"){
						header('Location: .\..\root.admin.companies.list\list.php');
						exit();
					}
					else{
						echo ('
							<div class="alert alert-danger">
								<label>Unknown error</label>
							</div>
							');
					}
					
				}
				else{
					echo ('
						<div class="alert alert-danger">
							<label>Wrong username or password!</label>
						</div>
						');
				}
			}
			?>