<?php
class OrdenModel extends Model{
    public function nuevaOrden(){
        //obtener los proovedores
        $this->query('SELECT id, empresa, razon_social, rut FROM proveedores');
        $lstProveedores = $this->resultSet();
        //obtener los items de la solicitud
        $this->query('SELECT * FROM item WHERE idSolicitud = :id_solicitud');
        $this->bind(':id_solicitud', $_SESSION['solicitudActual']['id']);
        $lstItems = $this->resultSet();
        $viewmodel = array(
            'proveedores' => $lstProveedores,
            'items' => $lstItems
        );
         return $viewmodel;
    }

    public function agregarOrden(){

        $error="";
        try{
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $error="Error al agregar la orden, no se cargaron ni servicios ni archivos";

                $this->query('INSERT INTO   ordenes (numero, anio, moneda, montoReal, plazoEntrega, formaPago,numeroAmpliacion, idProveedor,idSolicitud) VALUES (:numero, :anio, :moneda, :montoReal, :plazoEntrega, :formaPago,:numeroAmpliacion, :idProveedor, :idSolicitud)');
                $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
                $this->bind(':numero', $post['numero']);
                $this->bind(':anio', $post['anio']);
                $this->bind(':moneda', $post['moneda']);
                $this->bind(':montoReal', $post['montoReal']);
                $this->bind(':formaPago', $post['formaPago']);
                $this->bind(':plazoEntrega', $post['plazoEntrega']);
                $this->bind(':numeroAmpliacion', $post['numeroAmpliacion']);
                $this->bind(':idProveedor', $post['idProveedor']);
                $this->execute();

                $this->query('SELECT id FROM ordenes WHERE idSolicitud = :idSolicitud AND numero = :numero AND anio = :anio LIMIT 1' );
                $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
                $this->bind(':numero', $post['numero']);
                $this->bind(':anio', $post['anio']);
                $this->execute();
                $idOrden = $this->single();

                $error = "Error al agregar los items a la orden";
                if(isset($post['itemdescripcion'])){
                    for($i=0;$i<sizeof($post['itemdescripcion']);$i++){
                        $inicio=null;
                        $fin=null;
                        if($post['itemtipo'][$i] == 'General' || $post['itemtipo'][$i] == 'Licencia'  ){
                            $inicio = $post['iteminicio'][$i];
                            $fin = $post['itemfin'][$i];
                        }

                        $this->query('INSERT INTO itemOrden (descripcion, cantidad, unidad, monto, idOrden, idSolicitud, moneda, idItemSolicitud,esservicio,inicio,fin) VALUES (:descripcion, :cantidad, :unidad, :monto, :idOrden,:idSolicitud,:moneda,:idItemSolicitud,:esservicio,:inicio,:fin)');
                        $this->bind(':descripcion', $post['itemdescripcion'][$i]);
                        $this->bind(':cantidad', $post['itemcantidad'][$i]);
                        $this->bind(':unidad', $post['itemunidad'][$i]);
                        $this->bind(':monto', $post['itemprecio'][$i]);
                        $this->bind(':idOrden', $idOrden['id']);
                        $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
                        $this->bind(':moneda', $post['moneda']);
                        $this->bind(':idItemSolicitud', $post['itemidsolicitud'][$i]);
                        $this->bind(':esservicio', $post['itemtipo'][$i]);
                        $this->bind(':inicio',$inicio);
                        $this->bind(':fin', $fin);
                        $this->execute();
                    }
                }

                if(isset($post['pdf'])){
                    $error="Error al cargar los archivo/s adjunto/s:";
                    for($i=0; $i<sizeof($post['pdf']); $i++){
                        $error=$error.$post['pdfnombre'][$i]." ";
                        $this->query('INSERT INTO archivosordenes (`idSolicitud`,`idOrden`, `nombre`, `pdf`) VALUES(:idSolicitud, :idOrden, :nombre, :pdf)');
                        $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
                        $this->bind(':idOrden', $idOrden['id']);
                        $this->bind(':nombre', $post['pdfnombre'][$i]);
                        $this->bind(':pdf', $post['pdf'][$i]);
        
                        $this->execute();
                    }
                }

                $_SESSION['mensaje']['tipo'] = 'success';
                $_SESSION['mensaje']['contenido'] = 'Orden agregada correctamente';
                header('Location: '.ROOT_URL.'solicitudes/verSolicitud');
                return;
            }catch(PDOException $e){
                $_SESSION['mensaje']['tipo'] = 'error';
                $_SESSION['mensaje']['contenido'] = $error;
                header('Location: '.ROOT_URL.'solicitudes/verSolicitud');
                return;      
            }
    }
   


    public function seleccionarOrden(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post['idOrden'])){
            $_SESSION['ordenActual'] = $post['idOrden'];
        }
        header('Location: '.ROOT_URL.'orden/verOrden');
        return;
    }
///ver orden
    public function verOrden(){
    //este if es para detectar si abro una orden desde la vista de "compras realizadas", no deberia afectar el resto
        if(isset($_SESSION['idOrden'])){
            $_SESSION['ordenActual'] = $_SESSION['idOrden'];
            unset($_SESSION['idOrden']);
        }
    //----------------------------------
    


    $this->query('SELECT * FROM ordenes WHERE id = :id');
    $this->bind(':id',  $_SESSION['ordenActual'] );
    $orden = $this->single();

    $this->query('SELECT * FROM itemOrden WHERE idOrden = :idOrden');
    $this->bind(':idOrden',  $_SESSION['ordenActual'] );
    $items = $this->resultSet();

    ///obtener solicitud
    $this->query('SELECT * FROM solicitudescompra WHERE id = :id');
    $this->bind(':id',  $orden['idSolicitud'] );
    $solicitud = $this->single();
    
    $this->query('SELECT id, nombre FROM archivosordenes WHERE idOrden = :idOrden');
    $this->bind(':idOrden',  $_SESSION['ordenActual'] );
    $archivos = $this->resultSet();

    $this->query('SELECT * FROM servicios WHERE idOrden = :idOrden');
    $this->bind(':idOrden',  $_SESSION['ordenActual'] );
    $servicios = $this->resultSet();
    
    $this->query('SELECT * FROM proveedores WHERE id = :id');
    $this->bind(':id', $orden['idProveedor']);
    $proveedor = $this->single();
    
    $this->query('SELECT * FROM facturas WHERE idOrden = :idOrden');
    $this->bind(':idOrden',  $_SESSION['ordenActual'] );
    $facturas = $this->resultSet();

    
    $viewmodel = array(
        'orden' => $orden,
        'archivos' => $archivos,
        'proveedor' => $proveedor,
        'facturas' => $facturas,
        'solicitud' => $solicitud,
        'servicios' => $servicios,
        'items' => $items
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
        if(isset($post['pdf'])){
            $mensajeError="";
            for($i=0; $i<sizeof($post['pdf']); $i++){
                try{
                $this->query('INSERT INTO archivosordenes (`idSolicitud`,`idOrden`, `nombre`, `pdf`) VALUES(:idSolicitud, :idOrden, :nombre, :pdf)');
                $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
                $this->bind(':idOrden', $_SESSION['ordenActual']);
                $this->bind(':nombre', $post['pdfnombre'][$i]);
                $this->bind(':pdf', $post['pdf'][$i]);

                $this->execute();
                }catch(PDOException $e){
                    $mensajeError = $mensajeError."Error al subir el archivo ".$post['pdfnombre'][$i].". ";
                }
            }
            if($mensajeError==""){
                $_SESSION['mensaje']['tipo'] = 'success';
                $_SESSION['mensaje']['contenido'] = 'Archivos subidos correctamente';
                header('Location: '.ROOT_URL.'orden/verOrden#archivos');
                return;
            }else{
                $_SESSION['mensaje']['tipo'] = 'error';
                $_SESSION['mensaje']['contenido'] = $mensajeError;
                header('Location: '.ROOT_URL.'orden/verOrden#archivos');
                return;
            }
        }else{
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'No tenia ningun archivo en la lista';
            header('Location: '.ROOT_URL.'orden/verOrden#archivos');
        }
    }

    public function comprasRealizadas(){

        $this->query('SELECT * FROM ordenes');
        $row = $this->resultSet();

        $this->query('SELECT * FROM proveedores');
        $_SESSION['proveedores'] = $this->resultSet();


        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post) && isset($post['submit'])){
            if($post['submit'] == 'Ampliar'){
                $_SESSION['idOrden'] = $post['numero'];
                header('Location: '.ROOT_URL.'orden/verOrden');

            }


            if($_POST['submit'] == 'Filtrar'){

                $consulta = "SELECT * FROM ordenes WHERE ";
    
               /* if($post['fechaIni'] != "" && $post['fechaFin'] != "" ){
                    if($post['fechaIni'] != $post['fechaFin']){
                        $consulta = $consulta . "fechaHora BETWEEN '" . $post['fechaIni'] . "' AND '" . $post['fechaFin'] . "'";
                    }else{
                        $consulta = $consulta . "fechaHora LIKE '" . $post['fechaIni'] . "%'";
                    }
                    if($post['estado'] != '0' || $post['planificado'] != '0' || $post['procedimiento'] != '0' || $post['gastos_inversiones'] != '0'){$consulta .= " AND ";}
                }
    */
               
    
                if($post['procedimiento'] != '0'){
                    $consulta = $consulta . "procedimiento = '" . $post['procedimiento'] . "'";
                    if($post['servicio'] != '0' ){$consulta .= " AND ";}
    
                }
    
                if($post['servicio'] != '0'){
                    $consulta = $consulta . "servicio = '" . $post['servicio'] . "'";


                    if($post['fechaIni'] != "" && $post['fechaFin'] != "" ){

                        if($post['fechaIni'] == $post['fechaFin']){
                            $consulta = $consulta . " AND fechaInicio LIKE '" . $post['fechaIni'] . "%'";
                        }else{
                            $consulta = $consulta . " AND fechaInicio BETWEEN '" . $post['fechaIni'] . "' AND '" . $post['fechaFin'] . "'";
                        
                        }


                        if($post['fechaIni1'] != "" && $post['fechaFin1'] != ""){
                            if($post['fechaIni1'] == $post['fechaFin1']){
                                $consulta = $consulta . " AND fechaFin LIKE '" . $post['fechaIni1'] . "%'";
                            }else{
                                $consulta = $consulta . " AND fechaFin BETWEEN '" . $post['fechaIni1'] . "' AND '" . $post['fechaFin1'] . "'";
                            }
                           
                        }
                    }
    
                }
                //echo $consulta;
    
               
                if($consulta == "SELECT * FROM ordenes WHERE "){$consulta = "SELECT * FROM ordenes";}
                $this->query($consulta);
                $row = $this->resultSet();
            }

           
            
        }

        

        


        return $row;
    }
      
    public function editarOrden(){

        $this->query('SELECT * FROM proveedores');
        $proveedores = $this->resultSet();

        $this->query('SELECT * FROM item WHERE idSolicitud = :idSolicitud');
        $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
        $itemsSolicitud = $this->resultSet();


        $this->query('SELECT * FROM itemOrden WHERE idOrden = :idOrden');
        $this->bind(':idOrden', $_SESSION['ordenActual']);
        $itemsOrden = $this->resultSet();

        $this->query('SELECT *, p.empresa as nombreEmpresa FROM ordenes o JOIN proveedores p on o.idProveedor = p.id WHERE o.id = :id');
        $this->bind(':id', $_SESSION['ordenActual']);
        $orden = $this->single();
        $viewmodel = array(
            'proveedores' => $proveedores,
            'orden' => $orden,
            'itemsSolicitud' => $itemsSolicitud,
            'itemsOrden' => $itemsOrden
        );
        return $viewmodel;
    }
    
    public function modificarOrden(){

        try{
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $proveedor = $post['idProveedor'];

            if(isset($post['editadoIdProveedor'])){
                $proveedor = $post['editadoIdProveedor'];
            }
            if(isset($post['quitarItem'])){
                for($i = 0; $i < sizeof($post['quitarItem']); $i++){
                    $this->query('DELETE FROM itemOrden WHERE id = :id');
                    $this->bind(':id', $post['quitarItem'][$i]);
                    $this->execute();
                }
            }

            if(isset($post['itemdescripcion'])){
                for($i=0;$i<sizeof($post['itemdescripcion']);$i++){
                    $inicio=null;
                    $fin=null;
                    if($post['itemtipo'][$i] == 'General' || $post['itemtipo'][$i] == 'Licencia'  ){
                        $inicio = $post['iteminicio'][$i];
                        $fin = $post['itemfin'][$i];
                    }

                    $this->query('INSERT INTO itemOrden (descripcion, cantidad, unidad, monto, idOrden, idSolicitud, moneda, idItemSolicitud,esservicio,inicio,fin) VALUES (:descripcion, :cantidad, :unidad, :monto, :idOrden,:idSolicitud,:moneda,:idItemSolicitud,:esservicio,:inicio,:fin)');
                    $this->bind(':descripcion', $post['itemdescripcion'][$i]);
                    $this->bind(':cantidad', $post['itemcantidad'][$i]);
                    $this->bind(':unidad', $post['itemunidad'][$i]);
                    $this->bind(':monto', $post['itemprecio'][$i]);
                    $this->bind(':idOrden', $_SESSION['ordenActual']);
                    $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
                    $this->bind(':moneda', $post['moneda']);
                    $this->bind(':idItemSolicitud', $post['itemidsolicitud'][$i]);
                    $this->bind(':esservicio', $post['itemtipo'][$i]);
                    $this->bind(':inicio',$inicio);
                    $this->bind(':fin', $fin);
                    $this->execute();
                }
            }


            $this->query('UPDATE ordenes SET moneda = :moneda, montoReal = :montoReal, plazoEntrega = :plazoEntrega, formaPago = :formaPago, fechaInicio = :fechaInicio, fechaFin = :fechaFin, idProveedor = :idProveedor, numeroAmpliacion = :numeroAmpliacion WHERE id = :id');
            $this->bind(':id', $_SESSION['ordenActual']);
            $this->bind(':moneda', $post['moneda']);
            $this->bind(':montoReal', $post['montoReal']);
            $this->bind(':formaPago', $post['formaPago']);
            $this->bind(':plazoEntrega', $post['plazoEntrega']);

            $this->bind(':fechaInicio', $fechaini);
            $this->bind(':fechaFin', $fechafin);
            $this->bind(':idProveedor', $proveedor);
            $this->bind(':numeroAmpliacion', $post['numeroAmpliacion']);

            $this->execute();
            $_SESSION['mensaje']['tipo'] = 'success';
            $_SESSION['mensaje']['contenido'] = 'Orden modificada correctamente';
            header('Location: '.ROOT_URL.'orden/verOrden');
            return;

        }catch(PDOException $e){
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'Error al modificar la orden ...Prueba de nuevo mas tarde';
            header('Location: '.ROOT_URL.'orden/verOrden');
            return;      
        }

    }

    public function eliminarOrden(){
        try{
         
            // eliminar facturas, archivosfacturas, archivosOrdenes y ordenes
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //select de todas las facturas
            $this->query('SELECT * FROM facturas WHERE idOrden = :idOrden');
            $this->bind(':idOrden', $post['idOrden']);
            $facturas = $this->resultSet();
            //eliminar archivosfacturas
            foreach($facturas as $factura){
                $this->query('DELETE FROM archivosfacturas WHERE idFactura = :idFactura');
                $this->bind(':idFactura', $factura['id']);
                $this->execute();
            }
            //eliminar facturas
            $this->query('DELETE FROM facturas WHERE idOrden = :idOrden');
            $this->bind(':idOrden', $post['idOrden']);
            $this->execute();
            //eliminar archivosOrdenes
            $this->query('DELETE FROM archivosordenes WHERE idOrden = :idOrden');
            $this->bind(':idOrden', $post['idOrden']);
            $this->execute();
    
            //eliminar orden
            $this->query('DELETE FROM ordenes WHERE id = :idOrden');
            $this->bind(':idOrden', $post['idOrden']);
            $this->execute();
            $_SESSION['ordenActual'] = null;
            $_SESSION['mensaje']['tipo'] = 'success';
            $_SESSION['mensaje']['contenido'] = 'Orden eliminada correctamente';
            header('Location: '.ROOT_URL.'solicitudes/versolicitud');
        }catch(PDOException $e){
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'Error al eliminar la orden ...Prueba de nuevo mas tarde ';
            header('Location: '.ROOT_URL.'solicitudes/versolicitud');
        }
    }

    public function contratosAVencer (){


        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post) && isset($post['submit'])){
            if($post['submit'] == 'Ampliar'){
                $_SESSION['idOrden'] = $post['numero'];
                

            }
            header('Location: '.ROOT_URL.'orden/verOrden');
        }

        
        $this->query('SELECT * FROM proveedores');
        $_SESSION['proveedores'] = $this->resultSet();
        
       
        $this->query('SELECT * FROM `itemOrden` 
                    JOIN ordenes ON itemOrden.idOrden = ordenes.id
                    WHERE (esservicio = "General" OR esservicio="Licencia")and itemOrden.fin < (select curdate()) ORDER BY itemOrden.fin ASC');
        $_SESSION['vencidos'] = $this->resultSet();


        $this->query('SELECT * FROM `itemOrden` 
                    JOIN ordenes ON itemOrden.idOrden = ordenes.id
                    WHERE (esservicio = "General" OR esservicio="Licencia") and itemOrden.fin >= (select curdate()) ORDER BY itemOrden.fin ASC');
        $row = $this->resultSet();

        return $row;
    }

}
?>