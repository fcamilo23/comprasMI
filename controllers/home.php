<?php
class Home extends Controller{
	protected function index(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function cotizaciones(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->cotizaciones(), true);
	}

	protected function buscarContenido(){
		include './assets/utils/buscarContenido.php';

		$texto = @$_POST['texto'];
		$filtro = $_POST['filtro'];

		if($filtro=='articulo' && $filtro!=''){
			$contenido = buscarPedidos(new HomeModel(), $texto);
			if(count($contenido)>0){
				$_SESSION['contenidoBuscado'] = $contenido;
			}
			else{
				echo '<h1>No existen coincidencias</h1>';
			}
		}
		elseif($filtro=='viaje' && $filtro!=''){
			$contenido1 = buscarViajes(new HomeModel(), $texto);
			if(count($contenido1)>0){
				$_SESSION['contenidoBuscado2'] = $contenido1;
			}
			else{
				echo '<h1>No existen coincidencias</h1>';
			}
		}
	}
}