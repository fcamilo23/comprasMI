<?php
class Proveedor extends Controller{
	protected function listaProveedores(){
        $this->sesionAbierta ();
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->listaProveedores(), true);
    }
    protected function agregarProveedor(){
        $this->sesionAbierta ();
        $viewmodel = new ProveedorModel();
        $viewmodel->agregarProveedor();
        $this->listaProveedores();
    }

    protected function nuevoProveedor(){
        $this->sesionAbierta ();
        $this->returnView(null, true);
    }
    protected function seleccionarProveedor(){
        $this->sesionAbierta ();
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->seleccionarProveedor(), true);
    }   

    protected function verProveedor (){
        $this->sesionAbierta ();
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->verProveedor(), true);
    }

    protected function editarProveedor(){
        $this->sesionAbierta ();
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->editarProveedor(), true);
    }

    protected function realizarEditadoProveedor(){
        $this->sesionAbierta ();
        $viewmodel = new ProveedorModel();
        $viewmodel->realizarEditadoProveedor();
    }
    
    protected function agregarReferente(){
        $this->sesionAbierta ();
        $viewmodel = new ProveedorModel();
        $viewmodel->agregarReferente();
    }

    protected function editarReferente(){
        $this->sesionAbierta ();
        $viewmodel = new ProveedorModel();
        $viewmodel->editarReferente();
    }

    protected function sesionAbierta () {
       if (!isset($_SESSION['is_logged_in']) ||$_SESSION['is_logged_in'] == false){
            header('Location: '.ROOT_URL.'users/login');
        }
    }
}      
    



?>