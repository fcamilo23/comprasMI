<?php

class Users extends Controller{
	protected function register(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register(), true);
	}
	protected function verifyEmail(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->verifyEmail(), true);
	}

	protected function notificacionesUser(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->notificacionesUser(), true);
	}

	
	protected function cuponesUser(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->cuponesUser(), true);
	}

	protected function profile(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->profile(), true);
	}

	protected function postulacionesUser(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->postulacionesUser(), true);
	}

	protected function validatecedula(){
		include './assets/utils/validationAjax.php';
		if($_POST["cedula"] == ""){
			echo "Este campo es requerido";
		}
		else{
			if(!isValidatedcedula(new UserModel(), $_POST["cedula"])){
				echo "<tr><td class=rojo>Ya existe un usuario con este cedula</td></tr>"; 
			}
			else{
				echo "<tr><td class=verde>cedula disponible</td></tr>"; 
			}
		}
	}

	protected function validatePersonaReferida(){
		include './assets/utils/validationAjax.php';

			if(!isValidatedcedula(new UserModel(), $_POST["personaReferida"])){
				echo "<tr><td class=verde>cedula válido</td></tr>"; 
			}
			else{
				echo "<tr><td class=rojo>Este usuario no existe</td></tr>"; 
			}
	}

	protected function validateEmail(){
		include './assets/utils/validationAjax.php';
		if($_POST["email"] == ""){
			echo "Este campo es requerido";
		}
		else{
			if(!isValidatedcedula(new UserModel(), $_POST["email"])){
				echo "<tr><td class=rojo>Ya existe un usuario con este email</td></tr>"; 
			}
			else{
				echo "<tr><td class=verde>Email disponible</td></tr>"; 
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