<?php
class Oficina extends Controller{
	protected function listaOficinas(){
        $viewmodel = new oficinaModel();
        $this->returnView($viewmodel->listaOficinas(), true);
    }

}
?>