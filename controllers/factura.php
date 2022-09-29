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
        protected function seleccionFactura(){
        $viewmodel = new FacturaModel();
        $this->returnView($viewmodel->seleccionFactura(), true);
        }
        protected function verFactura(){
        $viewmodel = new FacturaModel();
        $this->returnView($viewmodel->verFactura(), true);
        }
        protected function eliminarFactura(){
        $viewmodel = new FacturaModel();
        $this->returnView($viewmodel->eliminarFactura(), true);
        }
        protected function verArchivo(){
        $viewmodel = new FacturaModel();
        $this->returnView($viewmodel->verArchivo(), true);     
        }
}

?>