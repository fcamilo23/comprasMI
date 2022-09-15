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

    protected function pruebaPDF(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->pruebaPDF(), true);
	}

	protected function verSolicitud(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->verSolicitud(), true);
	}
	protected function editarSolicitud(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->editarSolicitud(), true);
	}



}