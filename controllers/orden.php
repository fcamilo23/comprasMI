<?php
class Orden extends Controller{
    protected function nuevaOrden(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->nuevaOrden(), true);
    }
    protected function agregarOrden(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->agregarOrden(), true);
    }

    protected function verOrden(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->verOrden(), true);
    }

    protected function verArchivo(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->verArchivo(), true);
    }

    protected function eliminarArchivo(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->eliminarArchivo(), true);
    }

    protected function subirArchivos (){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->subirArchivos(), true);
    }

    protected function editarOrden(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->editarOrden(), true);
    }

    protected function modificarOrden(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->modificarOrden(), true);
    }
    protected function seleccionarOrden(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->seleccionarOrden(), true);
    }
    protected function eliminarOrden(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->eliminarOrden(), true);
    }
    
    
    protected  function isValidatedNumero(){
        include './assets/utils/validationAjax.php';
        if($_POST["numero"] == "" || $_POST["anio"] == ""){
            if($_POST["numero"] == "" && $_POST["anio"] == ""){
                echo "              El numero de orden y año es obligatorio ❌";
            }else{
                if($_POST["numero"] == ""){
                    echo "              El numero de orden es obligatorio ❌";
                }else{
                    echo "              El año es obligatorio ❌";
                }
            }
        }else{
                if(!isValidatedNumero(new OrdenModel(), $_POST["numero"], $_POST["anio"])){
                    echo "              La orden ya existe ❌"; 
                }
                else{
                    echo "true";
                }
        }
   
    }
}
?>