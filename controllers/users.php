<?php

class Users extends Controller{
	protected function register(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register(), true);
	}
	protected function setPass(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->setPass(), true);
	}

	protected function listaUsuarios(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->listaUsuarios(), true);
	}


	protected function profile(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->profile(), true);
	}



	protected function validatecedula(){
		include './assets/utils/validationAjax.php';
		if($_POST["cedula"] == ""){
			echo "Este campo es requerido";
		}
		else{
			if(!isValidatedcedula(new UserModel(), $_POST["cedula"])){
				echo "<label class=rojo>Ya existe un usuario con este cedula</label>"; 
			}
			else{
				echo "<label class=verde>cedula disponible</label>"; 
			}
		}
	}


	protected function validateEmail(){
		include './assets/utils/validationAjax.php';
		if($_POST["email"] == ""){
			echo "Este campo es requerido";
		}
		else{
			if(!isValidatedcedula(new UserModel(), $_POST["email"])){
				echo "<label class=rojo>Ya existe un usuario con este email</label>"; 
			}
			else{
				echo "<label class=verde>Email disponible</label>"; 
			}
		}
	}

	protected function login(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->login(), true);
	}

	protected function loginWithFacebook(){
		$viewmodel = new UserModel();
		return $viewmodel->loginWithFacebook();
	
		// $this->returnView($viewmodel->loginWithFacebook(), false);
	}

	protected function logout(){
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_data']);
		session_destroy();
		// Redirect
		header('Location: '.ROOT_URL);
	}
}