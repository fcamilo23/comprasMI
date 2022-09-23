<?php
class OrdenModel extends Model{
    public function nuevaOrden(){
        //obtener los proovedores
        $this->query('SELECT id, empresa, razon_social, rut FROM proveedores');
        $lstProveedores = $this->resultSet();
         return $lstProveedores;
    }

    public function agregarOrden(){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $fechaini=null; 
            $fechafin=null;
            $esservicio = 'no';
            $numeroAmpliacion = null;
            
            if($post['siservicio'] == 'si'){
                $fechaini = $post['inicio'];
                $fechafin = $post['fin'];
                $esservicio = 'si';
            }
            if(isset($post['numeroAmpliacion'])){
                $numeroAmpliacion = $post['numeroAmpliacion'];
            }

            $this->query('INSERT INTO   ordenes (numero, anio, moneda, montoReal, procedimiento, plazoEntrega, formaPago,numeroAmpliacion ,servicio, fechaInicio, fechaFin, idProveedor,idSolicitud) VALUES (:numero, :anio, :moneda, :montoReal, :procedimiento, :plazoEntrega, :formaPago,:numeroAmpliacion, :servicio, :fechaInicio, :fechaFin, :idProveedor, :idSolicitud)');
            $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
            $this->bind(':numero', $post['numero']);
            $this->bind(':anio', $post['anio']);
            $this->bind(':moneda', $post['moneda']);
            $this->bind(':montoReal', $post['montoReal']);
            $this->bind(':procedimiento', $post['procedimiento']);
            $this->bind(':formaPago', $post['formaPago']);
            $this->bind(':plazoEntrega', $post['plazoEntrega']);
            $this->bind(':numeroAmpliacion', $post['numeroAmpliacion']);
            $this->bind(':servicio', $esservicio);
            $this->bind(':fechaInicio', $fechaini);
            $this->bind(':fechaFin', $fechafin);
            $this->bind(':idProveedor', $post['idProveedor']);
            $this->execute();



            $this->query('SELECT id FROM ordenes WHERE idSolicitud = :idSolicitud AND numero = :numero AND anio = :anio LIMIT 1' );
            $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
            $this->bind(':numero', $post['numero']);
            $this->bind(':anio', $post['anio']);
            $this->execute();
            $idOrden = $this->single();


            if(isset($post['pdf'])){
                for($i=0; $i<sizeof($post['pdf']); $i++){
                    $this->query('INSERT INTO archivosordenes (`idSolicitud`,`idOrden`, `nombre`, `pdf`) VALUES(:idSolicitud, :idOrden, :nombre, :pdf)');
                    $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
                    $this->bind(':idOrden', $idOrden['id']);
                    $this->bind(':nombre', $post['pdfnombre'][$i]);
                    $this->bind(':pdf', $post['pdf'][$i]);
    
                    $this->execute();
                }
            }

        header('Location: '.ROOT_URL.'solicitudes/verSolicitud');
        return;
    }
    ///ver orden
    public function verOrden(){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post['idOrden'])){
            $_SESSION['ordenActual'] = $post['idOrden'];
        }
        $this->query('SELECT * FROM ordenes WHERE id = :id');
        $this->bind(':id',  $_SESSION['ordenActual'] );
        $orden = $this->single();
        $this->query('SELECT id, nombre FROM archivosordenes WHERE idOrden = :idOrden');
        $this->bind(':idOrden',  $_SESSION['ordenActual'] );
        $archivos = $this->resultSet();
        $this->query('SELECT * FROM proveedores WHERE id = :id');
        $this->bind(':id', $orden['idProveedor']);
        $proveedor = $this->single();
        
        $viewmodel = array(
            'orden' => $orden,
            'archivos' => $archivos,
            'proveedor' => $proveedor
        );
        return $viewmodel;

    }

    public function verArchivo(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->query('SELECT * FROM archivosordenes WHERE id = :id');
        $this->bind(':id', $post['idArchivo']);
        $viewmodel=$this->single();
        return $viewmodel;
    }

    public function eliminarArchivo(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->query('DELETE FROM archivosordenes WHERE id = :id');
        $this->bind(':id', $post['idArchivo']);
        $this->execute();
        header('Location: '.ROOT_URL.'orden/verOrden');
        return;
    }

    public function subirArchivos (){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        for($i=0; $i<sizeof($post['pdf']); $i++){
            $this->query('INSERT INTO archivosordenes (`idSolicitud`,`idOrden`, `nombre`, `pdf`) VALUES(:idSolicitud, :idOrden, :nombre, :pdf)');
            $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
            $this->bind(':idOrden', $_SESSION['ordenActual']);
            $this->bind(':nombre', $post['pdfnombre'][$i]);
            $this->bind(':pdf', $post['pdf'][$i]);

            $this->execute();
        }  
        header('Location: '.ROOT_URL.'orden/verOrden');
    }
    
    public function editarOrden(){
        //traer todos los proveedores
        $this->query('SELECT * FROM proveedores');
        $proveedores = $this->resultSet();
        //traer la orden
        $this->query('SELECT *, p.empresa as nombreEmpresa FROM ordenes o JOIN proveedores p on o.idProveedor = p.id WHERE o.id = :id');
        $this->bind(':id', $_SESSION['ordenActual']);
        $orden = $this->single();
        $viewmodel = array(
            'proveedores' => $proveedores,
            'orden' => $orden
        );
        return $viewmodel;
    }
    
    public function modificarOrden(){
        
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $fechaini=null; 
        $fechafin=null;
        $esservicio = 'no';
        $proveedor = $post['idProveedor'];
        
        if(isset($post['inicio']) && isset($post['fin']) && $post['inicio'] != '' && $post['fin'] != ''){
            $fechaini = $post['inicio'];
            $fechafin = $post['fin'];
            $esservicio = $post;
        }
        
        if(isset($post['editadoIdProveedor'])){
            $proveedor = $post['editadoIdProveedor'];
        }

        $this->query('UPDATE ordenes SET numero = :numero, anio = :anio, moneda = :moneda, montoReal = :montoReal, procedimiento = :procedimiento, plazoEntrega = :plazoEntrega, formaPago = :formaPago, servicio = :servicio, fechaInicio = :fechaInicio, fechaFin = :fechaFin, idProveedor = :idProveedor, numeroAmpliacion = :numeroAmpliacion WHERE id = :id');
        $this->bind(':id', $_SESSION['ordenActual']);
        $this->bind(':numero', $post['numero']);
        $this->bind(':anio', $post['anio']);
        $this->bind(':moneda', $post['moneda']);
        $this->bind(':montoReal', $post['montoReal']);
        $this->bind(':procedimiento', $post['procedimiento']);
        $this->bind(':formaPago', $post['formaPago']);
        $this->bind(':plazoEntrega', $post['plazoEntrega']);
        $this->bind(':servicio', $esservicio);
        $this->bind(':fechaInicio', $fechaini);
        $this->bind(':fechaFin', $fechafin);
        $this->bind(':idProveedor', $proveedor);
        $this->bind(':numeroAmpliacion', $post['numeroAmpliacion']);

        $this->execute();
        header('Location: '.ROOT_URL.'orden/verOrden');
        return;
    }

}
?>