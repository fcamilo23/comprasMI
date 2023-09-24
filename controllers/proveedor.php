<?php
class Proveedor extends Controller{
	protected function listaProveedores(){
        $this->sesionAbierta ("");
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->listaProveedores(), true);
    }
    protected function agregarProveedor(){
        $this->sesionAbierta ("Operador");
        $viewmodel = new ProveedorModel();
        $viewmodel->agregarProveedor();
        $this->listaProveedores();
    }

    protected function nuevoProveedor(){
        $this->sesionAbierta ("Operador");
        $this->returnView(null, true);
    }
    protected function seleccionarProveedor(){
        $this->sesionAbierta ("");
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->seleccionarProveedor(), true);
    }   

    protected function verProveedor (){
        $this->sesionAbierta ("");
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->verProveedor(), true);
    }

    protected function editarProveedor(){
        $this->sesionAbierta ("Operador");
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->editarProveedor(), true);
    }

    protected function realizarEditadoProveedor(){
        $this->sesionAbierta ("Operador");
        $viewmodel = new ProveedorModel();
        $viewmodel->realizarEditadoProveedor();
    }
    
    protected function agregarReferente(){
        $this->sesionAbierta ("Operador");
        $viewmodel = new ProveedorModel();
        $viewmodel->agregarReferente();
    }

    protected function editarReferente(){
        $this->sesionAbierta ("Operador");
        $viewmodel = new ProveedorModel();
        $viewmodel->editarReferente();
    }

    protected function sesionAbierta ($filtro) {
       if (!isset($_SESSION['is_logged_in']) ||$_SESSION['is_logged_in'] == false){
            header('Location: '.ROOT_URL.'users/login');
            return;
        }
        if($filtro == 'Operador'){
            if($_SESSION['user_data']['rol'] == 'Consultor'){
                header('Location: '.ROOT_URL);
                return;
            }
        }
     }
    
}      
?>