<?php
class Oficina extends Controller{
    
	protected function listaOficinas(){
        $this->sesionAbierta ();
        $viewmodel = new oficinaModel();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post['accion']) && $post['accion'] != '' && $_SESSION['user_data']['rol'] == 'Administrador'){
            $viewmodel->gestorOficina();
        }

        $viewmodel = new oficinaModel();
        $this->returnView($viewmodel->listaOficinas(), true);
    }
    protected function sesionAbierta () {
        if (!isset($_SESSION['is_logged_in']) ||$_SESSION['is_logged_in'] == false){
             header('Location: '.ROOT_URL.'users/login');
             return;
         }
    }

}
?>