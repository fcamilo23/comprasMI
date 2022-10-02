<?php
class Proveedor extends Controller{
	protected function listaProveedores(){
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->listaProveedores(), true);

    }
    protected function agregarProveedor(){
        $viewmodel = new ProveedorModel();
        $viewmodel->agregarProveedor();
        $this->listaProveedores();
    }

    protected function nuevoProveedor(){
        $this->returnView(null, true);
    }
    protected function seleccionarProveedor(){
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->seleccionarProveedor(), true);
    }   

    protected function verProveedor (){
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->verProveedor(), true);
    }

    protected function editarProveedor(){
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->editarProveedor(), true);
    }

    protected function realizarEditadoProveedor(){
        $viewmodel = new ProveedorModel();
        $viewmodel->realizarEditadoProveedor();
    }
    
    protected function agregarReferente(){
        $viewmodel = new ProveedorModel();
        $viewmodel->agregarReferente();
    }

    protected function editarReferente(){
        $viewmodel = new ProveedorModel();
        $viewmodel->editarReferente();
    }





}
?>