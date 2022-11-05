<?php 
class FacturaModel extends Model{
	public function nuevaFactura(){

		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(! isset($post['idOrden'])){
			header('Location: '.ROOT_URL);
		}
		$this->query('SELECT * FROM itemOrden WHERE idOrden = :idOrden');
		$this->bind(':idOrden', $post['idOrden']);
		$items = $this->resultSet();
		$this->query('SELECT * FROM ordenes WHERE id = :idOrden');
		$this->bind(':idOrden', $post['idOrden']);
		$orden = $this->single();
		$viewmodel = array(
			'orden' => $orden,
			'idProveedor' => $post['idProveedor'],
			'empresa' => $post['empresa'],
			'razon_social' => $post['razon_social'],
			'rut' => $post['rut'],
			'items' => $items
		);
    	return $viewmodel;
	}

	public function agregarFactura(){
		$error="Error al agregar la factura ...Prueba de nuevo mas tarde";
		try{
			
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$this->query('INSERT INTO facturas (idOrden, idProveedor,numeroFactura, monedaFactura, montoFactura, conceptoFactura,fechaFactura,estado) 
			VALUES (:idOrden, :idProveedor, :numeroFactura, :monedaFactura, :montoFactura, :conceptoFactura, :fechaFactura,"activo")');
			$this->bind(':idOrden', $post['idOrden']);
			$this->bind(':idProveedor', $post['idProveedor']);
			$this->bind(':numeroFactura', $post['numeroFactura']);
			$this->bind(':montoFactura', $post['montoFactura']);
			$this->bind(':monedaFactura', $post['monedaFactura']);
			$this->bind(':conceptoFactura', $post['conceptoFactura']);
			$this->bind(':fechaFactura', $post['fechaFactura']);
			$this->execute();
			
			//obtener el id de la factura recien creada
			$this->query('SELECT id FROM facturas WHERE idOrden = :idOrden AND numeroFactura = :numeroFactura LIMIT 1');
			$this->bind(':idOrden', $post['idOrden']);
			$this->bind(':numeroFactura', $post['numeroFactura']);
			$idFactura = $this->single();

			if(isset($post['descripcionItem'])){
				for($i=0; $i < count($post['descripcionItem']); $i++){
					// descontar de itemorden
					$this->query('UPDATE itemOrden SET sinFacturar = sinFacturar - :cantidadItem WHERE id = :id');
					$this->bind(':id', $post['idItem'][$i]);
					$this->bind(':cantidadItem', $post['cantidadItem'][$i]);
					$this->execute();
					$this->query('INSERT INTO itemfactura (cantidad, unidad, descripcion, idFactura, idOrden,idItemOrden  ) 
												VALUES (:cantidad, :unidad, :descripcion, :idFactura, :idOrden, :idItemOrden)');
					$this->bind(':cantidad', $post['cantidadItem'][$i]);
					$this->bind(':unidad', $post['unidadItem'][$i]);
					$this->bind(':descripcion', $post['descripcionItem'][$i]);
					$this->bind(':idFactura', $idFactura['id']);
					$this->bind(':idOrden', $post['idOrden']);
					$this->bind(':idItemOrden', $post['idItem'][$i]);
					$this->execute();
				}

			}
			if(isset($post['pdf'])){
				$error="Error al cargar los archivo/s adjunto/s:";
				for($i=0; $i<sizeof($post['pdf']); $i++){
					$error=$error.$post['pdfnombre'][$i]." ";
					$this->query('INSERT INTO archivosfacturas (idFactura, nombre, pdf) VALUES (:idFactura, :nombre, :pdf)');
					$this->bind(':idFactura', $idFactura['id']);

					$this->bind(':nombre', $post['pdfnombre'][$i]);
					$this->bind(':pdf', $post['pdf'][$i]);
	
					$this->execute();
				}
			}
		/*
		$error="Error al agregar archivo adjunto ...Prueba de nuevo mas tarde";
			// inserta en la tabla archivosFacturas
			$this->query('INSERT INTO archivosfacturas (idFactura, nombre, pdf) VALUES (:idFactura, :nombre, :pdf)');
			$this->bind(':idFactura', $idFactura['id']);
			$this->bind(':nombre', $post['pdfNombreFactura']);
			$this->bind(':pdf', $post['pdfFactura']);
		*/
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
			if(isset($post['idOrden'])){
				header('Location: '.ROOT_URL.'orden/verOrden');
			}else{
			header('Location: '.ROOT_URL);
			}
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
		if(!isset($_SESSION['idFactura']) || $_SESSION['idFactura'] =='' ){
			header('Location: '.ROOT_URL);
			return;
		}
		$this->query('SELECT * FROM facturas WHERE id = :idFactura');
		$this->bind(':idFactura', $_SESSION['idFactura']);
		$factura = $this->single();
		/// si factura no existe
		if(!$factura){
			$_SESSION['mensaje']['tipo'] = 'error';
			$_SESSION['mensaje']['contenido'] = 'Factura no encontrada';
			header('Location: '.ROOT_URL.'orden/verOrden');
			return;
		}
		$this->query('SELECT * FROM itemFactura WHERE idFactura = :idFactura');
		$this->bind(':idFactura', $_SESSION['idFactura']);
		$items = $this->resultSet();

		$this->query('SELECT id as idArchivo, nombre as nombreFactura FROM archivosfacturas WHERE idFactura = :idFactura');
		$this->bind(':idFactura', $_SESSION['idFactura']);
		$archivo = $this->resultSet();

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
			'items' => $items

		);
		return $viewmodel;
	}
/*
	public function eliminarFactura(){
		try{
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			if(isset($post['idFactura'])){
				$_SESSION ['idFactura'] = $post ['idFactura'];
			}else{
				header('Location: '.ROOT_URL);
				return;
			}
			$this->query('DELETE FROM itemFactura WHERE idFactura = :idFactura');

			$this->query('DELETE FROM archivosfacturas WHERE idFactura = :idFactura');
			$this->bind(':idFactura', $_SESSION['idFactura']);
			$this->execute();

			$this->query('DELETE FROM facturas WHERE id = :idFactura');
			$this->bind(':idFactura', $_SESSION['idFactura']);
			$this->execute();

			$_SESSION['mensaje']['tipo'] = 'success';
			$_SESSION['mensaje']['contenido'] = 'Factura eliminada correctamente';
			unset($_SESSION ['idFactura']);
			header('Location: '.ROOT_URL.'orden/verOrden');
			
			return;
		}catch(PDOException $e){
			$_SESSION['mensaje']['tipo'] = 'error';
			$_SESSION['mensaje']['contenido'] = 'Error al eliminar factura';
			header('Location: '.ROOT_URL.'orden/verOrden');
			return;
		}
	}
*/
	public function verArchivo(){

		
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post['idArchivo'])){
			$this->query('SELECT * FROM archivosfacturas WHERE id = :idArchivo');
			$this->bind(':idArchivo', $post['idArchivo']);
			$viewmodel = $this->single();
			return $viewmodel;
		}else{
			header('Location: '.ROOT_URL);
			return;
		}
	}

	public function anularFactura(){
	//	try{
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			if (isset($post['idFactura'])  && (isset($post['idOrden'])||isset($_SESSION['ordenActual'])||isset($_SESSION['idOrden']))){
				$_SESSION ['idFactura'] = $post ['idFactura'];
			}else{
				header('Location: '.ROOT_URL);
				return;
			}


			$this->query('UPDATE itemorden JOIN itemfactura ON itemorden.id = itemfactura.idItemOrden
						SET itemorden.sinFacturar = itemorden.sinFacturar + itemfactura.cantidad
						WHERE itemfactura.idFactura =:idFactura');
			$this->bind(':idFactura', $_SESSION['idFactura']);
			$this->execute();

			$this->query('UPDATE facturas SET estado = "inactivo" WHERE id = :idFactura');
			$this->bind(':idFactura', $_SESSION['idFactura']);
			$this->execute();


			$_SESSION['mensaje']['tipo'] = 'success';
			$_SESSION['mensaje']['contenido'] = 'Factura anulada correctamente';
			unset($_SESSION ['idFactura']);
			header('Location: '.ROOT_URL.'orden/verOrden');
			
			return;
	//	}catch(PDOException $e){
			$_SESSION['mensaje']['tipo'] = 'error';
			$_SESSION['mensaje']['contenido'] = 'Error al anular factura';
			header('Location: '.ROOT_URL.'orden/verOrden');
			return;
	//	}

	}
}