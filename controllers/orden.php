<?php
class Orden extends Controller{
    protected function nuevaOrden(){
        $viewmodel = new OrdenModel();
        $this->returnView($viewmodel->nuevaOrden(), true);
    }
}
?>