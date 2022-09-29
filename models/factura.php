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
		$error="Error al agregar la factura ...Prueba de nuevo mas tarde";
		try{
			
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

			$error="Error al agregar archivo adjunto ...Prueba de nuevo mas tarde";
			// inserta en la tabla archivosFacturas
			$this->query('INSERT INTO archivosfacturas (idFactura, nombre, pdf) VALUES (:idFactura, :nombre, :pdf)');
			$this->bind(':idFactura', $idFactura['id']);
			$this->bind(':nombre', $post['pdfNombreFactura']);
			$this->bind(':pdf', $post['pdfFactura']);

			$this->execute();
			$_SESSION['mensaje']['tipo'] = 'success';
            $_SESSION['mensaje']['contenido'] = 'Factura agregada correctamente';
			header('Location: '.ROOT_URL.'orden/verOrden');
			return;


		}catch(PDOException $e){
			try{
				$this->query('DELETE FROM facturas WHERE idOrden = :idOrden AND numeroFactura = :numeroFactura');
				$this->bind(':idOrden', $post['idOrden']);
				$this->bind(':numeroFactura', $post['numeroFactura']);
				$this->execute();
			}catch(PDOException $a) {}
			$_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = $error;
			header('Location: '.ROOT_URL.'orden/verOrden');
			return;
		}
	}

	public function seleccionFactura(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post['idFactura'])){
			$_SESSION ['idFactura'] = $post ['idFactura'];
		}
		header ('Location: '.ROOT_URL.'factura/verFactura');
	}

	public function verFactura(){

		$this->query('SELECT * FROM facturas WHERE id = :idFactura');
		$this->bind(':idFactura', $_SESSION['idFactura']);
		$factura = $this->single();

		$this->query('SELECT id as idArchivo, nombre as nombreFactura FROM archivosfacturas WHERE idFactura = :idFactura');
		$this->bind(':idFactura', $_SESSION['idFactura']);
		$archivo = $this->single();

		$this->query('SELECT id as idOrden, numero as numeroOrden, anio as anioOrden FROM ordenes WHERE id = :idOrden');
		$this->bind(':idOrden', $factura['idOrden']);
		$orden = $this->single();
		
		$this->query('SELECT  id as idProveedor ,empresa, razon_social, rut FROM proveedores WHERE id = :idProveedor');
		$this->bind(':idProveedor', $factura['idProveedor']);
		$proveedor = $this->single();


		$viewmodel = array(
			'archivosFacuturas' => $archivo,
			'orden' => $orden,
			'proveedor' => $proveedor,
			'idFactura' => $factura['id'],
			'idOrden' => $factura['idOrden'],
			'idProveedor' => $factura['idProveedor'],
			'numeroFactura' => $factura['numeroFactura'],
			'monedaFactura' => $factura['monedaFactura'],
			'montoFactura' => $factura['montoFactura'],
			'conceptoFactura' => $factura['conceptoFactura'],
			'fechaFactura' => $factura['fechaFactura'],

		);
		return $viewmodel;
	}

	public function eliminarFactura(){
		try{
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			if(isset($post['idFactura'])){
				$_SESSION ['idFactura'] = $post ['idFactura'];
			}

			$this->query('DELETE FROM archivosfacturas WHERE idFactura = :idFactura');
			$this->bind(':idFactura', $_SESSION['idFactura']);
			$this->execute();

			$this->query('DELETE FROM facturas WHERE id = :idFactura');
			$this->bind(':idFactura', $_SESSION['idFactura']);
			$this->execute();

			$_SESSION['mensaje']['tipo'] = 'success';
			$_SESSION['mensaje']['contenido'] = 'Factura eliminada correctamente';
			header('Location: '.ROOT_URL.'orden/verOrden');
			return;
		}catch(PDOException $e){
			$_SESSION['mensaje']['tipo'] = 'error';
			$_SESSION['mensaje']['contenido'] = 'Error al eliminar factura';
			header('Location: '.ROOT_URL.'orden/verOrden');
			return;
		}
	}
	
	public function verArchivo(){
		
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$this->query('SELECT * FROM archivosfacturas WHERE id = :idArchivo');
			$this->bind(':idArchivo', $post['idArchivo']);
			$viewmodel = $this->single();
			return $viewmodel;
	}
}