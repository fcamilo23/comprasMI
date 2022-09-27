<?php
class Factura extends Controller{
	protected function nuevaFactura(){
        $viewmodel = new FacturaModel();
        $this->returnView($viewmodel->nuevaFactura(), true);
	}
        protected function agregarFactura(){
        $viewmodel = new FacturaModel();
        $this->returnView($viewmodel->agregarFactura(), true);
        }
}

?>