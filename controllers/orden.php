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
}
?>