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
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post['accion']) && $post['accion'] != ''){
            if($post['accion']=='newreferente'){
            $viewmodel->agregarReferente();
            
            }else{
                if($post['accion']=='ediproveedor'){
                    $viewmodel->editarReferente();
                }else{
                    if($post['accion']=='editarProveedor'){
                        $viewmodel->editarProveedor();
                    }
                }
            }
        }
        $viewmodel = new ProveedorModel();
        $this->returnView($viewmodel->verProveedor(), true);
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