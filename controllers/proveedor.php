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
    protected function verProveedor (){
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->verProveedor(), true);
    }



}
?>