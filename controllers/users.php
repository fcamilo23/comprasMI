<?php

class Users extends Controller{
	protected function register(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register(), true);
	}
	protected function setPass(){
		$this->sesionAbierta ();
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->setPass(), true);
	}

	protected function listaUsuarios(){
		$this->sesionAbierta ();
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->listaUsuarios(), true);
	}


	protected function profile(){
		$this->sesionAbierta ();
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->profile(), true);
	}
	protected function resetPassword(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->resetPassword(), true);
	}

	protected function editar(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->editar(), true);
	}

	



	protected function validatecedula(){
		include './assets/utils/validationAjax.php';
		if($_POST["cedula"] == ""){
			echo "Este campo es requerido";
		}
		else{
			if(!isValidatedcedula(new UserModel(), $_POST["cedula"])){
				echo "<label class=rojo>Ya existe un usuario con esta CI</label>"; 
			}
			else{
				echo "<label class=verde>CI disponible</label>"; 
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
	
	protected function sesionAbierta () {
		if (!isset($_SESSION['is_logged_in']) ||$_SESSION['is_logged_in'] == false){
			 header('Location: '.ROOT_URL.'users/login');
		 }
	}
	

}