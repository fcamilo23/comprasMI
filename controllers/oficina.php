<?php
class Oficina extends Controller{
    
	protected function listaOficinas(){
        $viewmodel = new oficinaModel();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post['accion'])&& $post['accion'] != ''){
            $viewmodel->gestorOficina();
        }

        $viewmodel = new oficinaModel();
        $this->returnView($viewmodel->listaOficinas(), true);
    }

}
?>