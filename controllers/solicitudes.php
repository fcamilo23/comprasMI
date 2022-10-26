<?php
class Solicitudes extends Controller{
	protected function listaSolicitudes(){
		$this->sesionAbierta ();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->listaSolicitudes(), true);
	}
	protected function nuevaSolicitud(){
		$this->sesionAbierta ();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->nuevaSolicitud(), true);
	}

    protected function nuevoArchivo(){
		$this->sesionAbierta ();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->nuevoArchivo(), true);
	}

	protected function verSolicitud(){
		$this->sesionAbierta ();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->verSolicitud(), true);
	}
	protected function editarSolicitud(){
		$this->sesionAbierta ();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->editarSolicitud(), true);
	}

	protected function nuevaNovedad(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->nuevaNovedad(), true);
	}
	protected function subirarchivos(){
		$this->sesionAbierta ();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->subirarchivos(), true);
	}

	protected function verArchivo(){
		$this->sesionAbierta ();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->verArchivo(), true);
	}

	protected function eliminarArchivo(){
		$this->sesionAbierta ();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->eliminarArchivo(), true);
	}
	
	protected function sesionAbierta () {
		if (!isset($_SESSION['is_logged_in']) ||$_SESSION['is_logged_in'] == false){
			 header('Location: '.ROOT_URL.'users/login');
		 }
	}


	



}