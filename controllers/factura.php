<?php
class Factura extends Controller{
	protected function nuevaFactura(){
                $this->sesionAbierta();
                $viewmodel = new FacturaModel();
                $this->returnView($viewmodel->nuevaFactura(), true);
	}
        protected function agregarFactura(){
                $this->sesionAbierta();
                $viewmodel = new FacturaModel();
                $this->returnView($viewmodel->agregarFactura(), true);
        }
        protected function seleccionFactura(){
                $this->sesionAbierta();
                $viewmodel = new FacturaModel();
                $this->returnView($viewmodel->seleccionFactura(), true);
        }
        protected function verFactura(){
                $this->sesionAbierta();
                $viewmodel = new FacturaModel();
                $this->returnView($viewmodel->verFactura(), true);
        }
        protected function eliminarFactura(){
                $this->sesionAbierta();
                $viewmodel = new FacturaModel();
                $this->returnView($viewmodel->eliminarFactura(), true);
        }
        protected function verArchivo(){
                $this->sesionAbierta();
                $viewmodel = new FacturaModel();
                $this->returnView($viewmodel->verArchivo(), true);     
        }
        protected function sesionAbierta () {
                if (!isset($_SESSION['is_logged_in']) ||$_SESSION['is_logged_in'] == false){
                        header('Location: '.ROOT_URL.'users/login');
                }
         }
}

?>