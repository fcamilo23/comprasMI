<?php
class Solicitudes extends Controller{
	protected function listaSolicitudes(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->listaSolicitudes(), true);
	}
	protected function nuevaSolicitud(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->nuevaSolicitud(), true);
	}

    protected function nuevoArchivo(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->nuevoArchivo(), true);
	}

	protected function verSolicitud(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->verSolicitud(), true);
	}
	protected function editarSolicitud(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->editarSolicitud(), true);
	}
	protected function nuevaNovedad(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->nuevaNovedad(), true);
	}
	protected function prueba(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->prueba(), true);
	}

	protected function obtener($idpdf){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->obtener($idpdf), true);
	}


}