<?php 
class FacturaModel extends Model{
	public function nuevaFactura(){

		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(! isset($post['idOrden'])){
			header('Location: '.ROOT_URL.'orden/verOrden');
		}
		$viewmodel = array(
			'idOrden' => $post['idOrden'],
			'idProveedor' => $post['idProveedor'],
			'numero' => $post['numero'],
			'anio' => $post['anio'],
			'moneda' => $post['moneda'],
			'empresa' => $post['empresa'],
			'razon_social' => $post['razon_social'],
			'rut' => $post['rut'],
		);
    	return $viewmodel;
	}

	public function agregarFactura(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->query('INSERT INTO facturas (idOrden, idProveedor,numeroFactura, monedaFactura, montoFactura, conceptoFactura,fechaFactura) VALUES (:idOrden, :idProveedor, :numeroFactura, :monedaFactura, :montoFactura, :conceptoFactura, :fechaFactura)');
		$this->bind(':idOrden', $post['idOrden']);
		$this->bind(':idProveedor', $post['idProveedor']);
		$this->bind(':numeroFactura', $post['numeroFactura']);
		$this->bind(':montoFactura', $post['montoFactura']);
		$this->bind(':monedaFactura', $post['monedaFactura']);
		$this->bind(':conceptoFactura', $post['conceptoFactura']);
		$this->bind(':fechaFactura', $post['fechaFactura']);
		$this->execute();

		//obtener el id de la factura recien creada
		$this->query('SELECT id FROM facturas WHERE idOrden = :idOrden AND numeroFactura = :numeroFactura');
		$this->bind(':idOrden', $post['idOrden']);
		$this->bind(':numeroFactura', $post['numeroFactura']);
		$idFactura = $this->single();
		
		//crear el archivo pdf


		header('Location: '.ROOT_URL.'orden/verOrden');
		return;
	}
}