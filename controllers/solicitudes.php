<?php
class Solicitudes extends Controller{
	protected function listaSolicitudes(){
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->listaSolicitudes(), true);
	}

    protected function downloadFile(){
        ob_start();
		$viewmodel = new SolicitudesModel();
		$this->returnView($viewmodel->downloadFile(), true);
	}


}