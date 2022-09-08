<?php 
	function isValidatedcedula($userModel, $cedula){
		$userModel->query('SELECT * FROM Usuarios WHERE cedula = :cedula');
		$userModel->bind(':cedula', $cedula);
		$row = $userModel->single();
		if($row){
			return false;
		}
		else{
			return true;
		}
    }

	function isValidatedEmail($userModel, $email){
		$userModel->query('SELECT * FROM Usuarios WHERE email = :email');
		$userModel->bind(':email', $email);
		$row = $userModel->single();
		if($row){
			return false;
		}
		else{
			return true;
		}
    }
?>