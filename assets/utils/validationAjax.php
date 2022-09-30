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

	function isValidatedSR($solicitudesModel, $sr){
		$solicitudesModel->query('SELECT * FROM solicitudescompra WHERE SR = :sr');
		$solicitudesModel->bind(':sr', $sr);
		$row = $solicitudesModel->single();
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
	
	function isValidatedNumero($userModel, $numero,$anio){
		$userModel->query('SELECT * FROM Ordenes WHERE numero = :numero AND anio = :anio');
		$userModel->bind(':numero', $numero);
		$userModel->bind(':anio', $anio);
		$row = $userModel->single();
		if($row){
			return false;
		}else{
			return true;
		}
    }


?>