<?php
class Orden extends Controller{
    protected function nuevaOrden(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->nuevaOrden(), true);
    }
    protected function agregarOrden(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->agregarOrden(), true);
    }

    protected function verOrden(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->verOrden(), true);
    }

    protected function verArchivo(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->verArchivo(), true);
    }

    protected function eliminarArchivo(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->eliminarArchivo(), true);
    }

    protected function subirArchivos (){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->subirArchivos(), true);
    }

    protected function editarOrden(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->editarOrden(), true);
    }

    protected function modificarOrden(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->modificarOrden(), true);
    }
    protected function seleccionarOrden(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->seleccionarOrden(), true);
    }
    protected function eliminarOrden(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->eliminarOrden(), true);
    }  
    
    protected  function isValidatedNumero(){
        include './assets/utils/validationAjax.php';
        if($_POST["numero"] == "" || $_POST["anio"] == ""){
            if($_POST["numero"] == "" && $_POST["anio"] == ""){
                echo "                                                                       El numero de orden y año es obligatorio ❌";
            }else{
                if($_POST["numero"] == ""){
                    echo "                                                                       El numero de orden es obligatorio ❌";
                }else{
                    echo "                                                                       El año es obligatorio ❌";
                }
            }
        }else{
                if(!isValidatedNumero(new OrdenModel(), $_POST["numero"], $_POST["anio"])){
                    echo "                                                                       La orden ya existe ❌"; 
                }
                else{
                    echo "true";
                }
        }
   
    }

    protected function comprasRealizadas(){
        $this->sesionAbierta ();
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->comprasRealizadas(), true);
    }

    protected function contratosAVencer(){
        $this->sesionAbierta ();
		$viewmodel = new OrdenModel();
		$this->returnView($viewmodel->contratosAVencer(), true);
	}
    
    protected function sesionAbierta () {
        if (!isset($_SESSION['is_logged_in']) ||$_SESSION['is_logged_in'] == false){
             header('Location: '.ROOT_URL.'users/login');
         }
    }

}
?>