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

	protected function subirarchivos(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->subirarchivos(), true);

	}

	protected function verArchivo(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->verArchivo(), true);
	}

	protected function eliminarArchivo(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->eliminarArchivo(), true);
	}

	



}