<?php
class SolicitudesModel extends Model{


  



	public function listaSolicitudes(){
        $this->limpiarMemoria();
        $_SESSION['items'] = array();

        



        $this->query('SELECT * FROM solicitudescompra');
        $lstSolicitudes = $this->resultSet();
        $_SESSION['solicitudesExcel'] = $lstSolicitudes;


        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post) && isset($post['submit'])){
            if($_POST['submit'] == 'Ampliar'||$_POST['submit'] == 'Ir a la Solicitud'){
            $id = $post['numero'];

            
            $this->query('SELECT * FROM solicitudescompra WHERE id = "'. $id .'"');
            $row = $this->single();


            $_SESSION['solicitudActual'] = array(
                "id"	=> $row['id'],
                "SR"	=> $row['SR'],
                "planificado"	=> $row['planificado'],
                "gastos_inversiones"	=> $row['gastos_inversiones'],
                "grupoAS"	=> $row['grupoAS'],
                "artServ"	=> $row['artServ'],
                "detalle"	=> $row['detalle'],
                "cantidad"	=> $row['cantidad'],
                "unidad"	=> $row['unidad'],
                "estado"	=> $row['estado'],
                "oficinaSolicitante"	=> $row['oficinaSolicitante'],
                "uo"	=> $row['UO'],
                "fechaHora"	=> $row['fechaHora'],
                "costoAprox"	=> $row['costoAprox'],
                "referente"	=> $row['referente'],
                "contactoReferente"	=> $row['contactoReferente'],
                "observaciones"	=> $row['observaciones'],
                "procedimiento"	=> $row['procedimiento'],
                "numProcedimiento"	=> $row['numProc'],
                "anioProcedimiento"	=> $row['anioProc'],


            );
            $_SESSION['respaldoSolicitud'] = $_SESSION['solicitudActual'];


            header('Location: '.ROOT_URL.'solicitudes/verSolicitud');
        }

        if($_POST['submit'] == 'Filtrar'){

            $consulta = "SELECT * FROM solicitudescompra WHERE ";

            if($post['fechaIni'] != "" && $post['fechaFin'] != "" ){
                if($post['fechaIni'] != $post['fechaFin']){
                    $consulta = $consulta . "fechaHora BETWEEN '" . $post['fechaIni'] . "' AND '" . $post['fechaFin'] . "'";
                }else{
                    $consulta = $consulta . "fechaHora LIKE '" . $post['fechaIni'] . "%'";
                }
                if($post['estado'] != '0' || $post['planificado'] != '0' || $post['procedimiento'] != '0' || $post['gastos_inversiones'] != '0'){$consulta .= " AND ";}
            }

            if($post['estado'] != '0'){
                $consulta = $consulta . "estado = '" . $post['estado'] . "'";
                if($post['planificado'] != '0' || $post['procedimiento'] != '0' || $post['gastos_inversiones'] != '0' ){$consulta .= " AND ";}
            }

            if($post['planificado'] != '0'){
                $consulta = $consulta . "planificado = '" . $post['planificado'] . "'";
                if($post['procedimiento'] != '0' || $post['gastos_inversiones'] != '0' ){$consulta .= " AND ";}

            }

            if($post['procedimiento'] != '0'){
                $consulta = $consulta . "procedimiento = '" . $post['procedimiento'] . "'";
                if($post['gastos_inversiones'] != '0' ){$consulta .= " AND ";}

            }

            if($post['gastos_inversiones'] != '0'){
                $consulta = $consulta . "gastos_inversiones = '" . $post['gastos_inversiones'] . "'";

            }
            //echo $consulta;

            if($consulta == "SELECT * FROM solicitudescompra WHERE "){$consulta = "SELECT * FROM solicitudescompra";}
            $this->query($consulta);
            $lstSolicitudes = $this->resultSet();
            

        }
    }

        
        

       
        return $lstSolicitudes;
    }

    public function nuevoArchivo(){

if (isset($_POST['submit'])) {
 
    $name = $_POST['name'];

    if (isset($_FILES['pdf_file']['name']))
    {
      $file_name = $_FILES['pdf_file']['name'];
      $file_tmp = $_FILES['pdf_file']['tmp_name'];

      //move_uploaded_file($file_tmp,"./pdf/".$file_name);

      $this->query("INSERT INTO pdf_data(username,filename) VALUES('$name','$file_name')");
      $this->execute();
    }
    else
    {
       ?>
        <div class=
        "alert alert-danger alert-dismissible
        fade show text-center">
          <a class="close" data-dismiss="alert"
             aria-label="close">×</a>
          <strong>Failed!</strong>
              File must be uploaded in PDF format!
        </div>
      <?php
    }
}



  
         
        return;
    }

    public function prueba (){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post['pdf'])){
            $pdf = $post['pdf'];
            $this->query('INSERT INTO subirpdf (archivo) VALUES (:pdf)');
            $this->bind(':pdf', $pdf);
            $this->execute();
            if($this->lastInsertId()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function obtenerPesosUruguayos($valorInicial, $moneda, $anio, $montoReal){
       // $anio = 2022;
        $this->query('SELECT * FROM `cotizaciones` WHERE anio = "'. $anio .'" AND moneda = "Dolar"'); // JOIN ordenes ON ordenes.idSolicitud = solicitudescompra.id');
        $dolar = $this->single();
        $this->query('SELECT * FROM `cotizaciones` WHERE anio = "'. $anio .'" AND moneda = "U.I.(Unidades Indexadas)"'); // JOIN ordenes ON ordenes.idSolicitud = solicitudescompra.id');
        $UI = $this->single();
        $this->query('SELECT * FROM `cotizaciones` WHERE anio = "'. $anio .'" AND moneda = "U.R. (Unidades Reajustables)"'); // JOIN ordenes ON ordenes.idSolicitud = solicitudescompra.id');
        $UR = $this->single();
        $this->query('SELECT * FROM `cotizaciones` WHERE anio = "'. $anio .'" AND moneda = "€ (Euro)"'); // JOIN ordenes ON ordenes.idSolicitud = solicitudescompra.id');
        $euro = $this->single();

        if($dolar != null){


        if($moneda == '$ (Pesos Uruguayos)'){
            $valorInicial = $valorInicial + $montoReal;
        }
        if($moneda == 'U$S (Dolares)'){
            $monto = $montoReal * $dolar['valor'];
            $valorInicial = $valorInicial + $monto;

        }
        if($moneda == 'U.I.(Unidades Indexadas)'){
            $monto = $montoReal * $UI['valor'];
            $valorInicial = $valorInicial + $monto;
        }
        if($moneda == 'U.R. (Unidades Reajustables)'){
            $monto = $montoReal * $UR['valor'];
            $valorInicial = $valorInicial + $monto;
        }
        if($moneda == '€ (Euro)'){
            $monto = $montoReal * $euro['valor'];
            $valorInicial = $valorInicial + $monto;
        }

        return $valorInicial;
    }else{
        Messages::setMsg('Debes agregar una instancia de cotizaciones para el año '.$anio , 'warning');

    }
    }




    public function ejecucionInversiones(){
        
        $anio = date('Y');
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        if(isset($post) && isset($post['submit'])){
            $anio = $post['anio'];
            $_SESSION['anioInversiones'] = $anio;
        }
        //$this->query('SELECT * FROM `cotizaciones` WHERE anio = "'. $anio .'" AND moneda = "Dolar"'); // JOIN ordenes ON ordenes.idSolicitud = solicitudescompra.id');
        //$dolar = $this->single();

        $this->query('SELECT * FROM `solicitudescompra` WHERE fechaPrimerOrden LIKE "'.$anio.'%" AND (grupoAS = "Equipos de Informática" OR grupoAS = "Equipos de Comunicaciones" OR grupoAS = "Programas de Computación")'); // JOIN ordenes ON ordenes.idSolicitud = solicitudescompra.id');
        $row = $this->resultSet();

       
        //echo $anio;


      


    foreach ($row as $item) {

        $this->query('SELECT * FROM `item` WHERE idSolicitud = "'.$item['id'].'"'); // JOIN ordenes ON ordenes.idSolicitud = solicitudescompra.id');
        $itemsoli = $this->resultSet();
        $costoAprox = 0;
        foreach ($itemsoli as $items){
            $costoAprox = $costoAprox + $items['total'];
        }
        //echo $item['id'];

        //TODO ESTO ES PARA CARGAR EL VALOR CORRECTO EN PESOS URUGUAYOS EN LA SOLICITUD--------------------------
        $this->query('SELECT * FROM ordenes WHERE idSolicitud = "'. $item['id'] .'"');
        $ordenes = $this->resultSet();
        $montoRealPesos = 0;
        $montoFacturadoPesos = 0;


        foreach ($ordenes as $orden){

            $montoRealPesos = $this->obtenerPesosUruguayos($montoRealPesos, $orden['moneda'], $anio, $orden['montoReal']);
           
            $this->query('SELECT * FROM facturas WHERE idOrden = "'. $orden['id'] .'"');
            $facturas = $this->resultSet();

            foreach ($facturas as $factura){
                $montoFacturadoPesos = $this->obtenerPesosUruguayos($montoFacturadoPesos, $factura['monedaFactura'], $anio, $factura['montoFactura']);
                
            }

            
            
        }
        $this->query('UPDATE solicitudescompra SET costoAprox = "'. $costoAprox .'" WHERE id = "'. $item['id'] . '" ');
        $this->execute();

        $this->query('UPDATE solicitudescompra SET montoRealOrden = "'. $montoRealPesos .'" WHERE id = "'. $item['id'] . '" ');
        $this->execute();

        $this->query('UPDATE solicitudescompra SET montoRealFacturado = "'. $montoFacturadoPesos .'" WHERE id = "'. $item['id'] . '" ');
        $this->execute();

       // echo 'Soli: ' .$montoRealPesos. '           ' ;

       // ACA TERMINA LA CARGA DEL MONTO REAL DE LAS ORDENES ------------------------------------------------





    }  
    
        return $row;
    }


    public function verSolicitud(){

        


        $this->query('SELECT * FROM item WHERE idSolicitud="'.$_SESSION['solicitudActual']['id'].'"');
        $_SESSION['items'] = $this->resultSet();


        $this->query('SELECT * FROM novedades WHERE idSolicitud="'.$_SESSION['solicitudActual']['id'].'" ORDER BY id DESC');
        $_SESSION['novedades'] = $this->resultSet();

        $this->query('SELECT * FROM archivosSolicitudes WHERE idSolicitud="'.$_SESSION['solicitudActual']['id'].'"');
        $_SESSION['archivos'] = $this->resultSet();

        $this->query('SELECT *, p.empresa as proveedor, o.id as idOrden FROM ordenes o JOIN proveedores p ON o.idProveedor = p.id WHERE o.idSolicitud="'.$_SESSION['solicitudActual']['id'].'"');
        $_SESSION['ordenes'] = $this->resultSet();

        
        
        return;
        
         
    }


    public function nuevaNovedad(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post && $post['submit']){
            $date = new DateTime("now", new DateTimeZone('America/Montevideo') );
            $fecha = $date->format('Y-m-d H:i:s');
            $this->query('INSERT INTO novedades(idSolicitud, texto, fecha) VALUES("'. $_SESSION['solicitudActual']['id'] .'","'. $post['texto'] .'", "'. $fecha. '")');
            $this->execute();

            //$_SESSION['alertAddNovedad'] = '1';
            $_SESSION['mensaje']['tipo'] = 'success';
            $_SESSION['mensaje']['contenido'] = 'Perfecto! Se ha agregado la novedad';

            //agregarCartel
            header('Location: '.ROOT_URL.'solicitudes/verSolicitud');


        }


        return;
        
         
    }


    public function editarSolicitud(){

        $this->query('SELECT * FROM oficinas');
        $row = $this->resultSet();

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post && $post['submit']){

            if($post['submit'] == "Guardar Cambios"){

                $this->query('SELECT * FROM solicitudescompra WHERE sr = "'. $post['sr'] .'" AND sr <> "'.$post['srActual'].'"');
                $sr = $this->single();

                if($sr == null){
                $this->query('UPDATE solicitudescompra SET SR = :sr, planificado = :planificado, gastos_inversiones = :gastos_inversiones, grupoAS=:grupoAS, artServ=:artServ, detalle=:detalle, estado=:estado, oficinaSolicitante=:oficinaSolicitante, UO=:uo, costoAprox=:costoAprox, referente=:referente, contactoReferente=:contactoReferente, observaciones=:observaciones, procedimiento=:procedimiento, numProc=:numProcedimiento, anioProc=:anioProcedimiento WHERE id=:id'); 
                $this->bind(':sr', $post['sr']);
				$this->bind(':planificado', $post['planificado']);
                $this->bind(':gastos_inversiones', $post['gastos_inversiones']);
				$this->bind(':grupoAS', $post['grupoAS']);
				$this->bind(':artServ', $post['artServ']);
				$this->bind(':detalle', $post['detalle']);
				$this->bind(':estado', $post['estado']);
				$this->bind(':oficinaSolicitante', $post['oficinaSolicitante']);
                $this->bind(':uo', $post['UO']);
				$this->bind(':costoAprox', $post['costo']);
				$this->bind(':referente', $post['referente']);
				$this->bind(':contactoReferente', $post['contactoReferente']);
                $this->bind(':observaciones', $post['observaciones']);
				$this->bind(':procedimiento', $post['procedimiento']);
                $this->bind(':numProcedimiento', $post['numProcedimiento']);
				$this->bind(':anioProcedimiento', $post['anioProcedimiento']);
                $this->bind(':id', $post['id']);

                $this->execute();
                //$_SESSION['alertEditarSoli'] = '1';
                $_SESSION['mensaje']['tipo'] = 'success';
                $_SESSION['mensaje']['contenido'] = 'Perfecto! Se han efectuado los cambios';

                $_SESSION['solicitudActual'] = array(
                    "id"	=> $post['id'],
                    "SR"	=> $post['sr'],
                    "planificado"	=> $post['planificado'],
                    "gastos_inversiones"	=> $post['gastos_inversiones'],
                    "grupoAS"	=> $post['grupoAS'],
                    "artServ"	=> $post['artServ'],
                    "detalle"	=> $post['detalle'],
                    "estado"	=> $post['estado'],
                    "oficinaSolicitante"	=> $post['oficinaSolicitante'],
                    "uo"	=> $post['UO'],
                    "fechaHora"	=> $post['fechaHora'],
                    "costoAprox"	=> $post['costo'],
                    "referente"	=> $post['referente'],
                    "contactoReferente"	=> $post['contactoReferente'],
                    "observaciones"	=> $post['observaciones'],
                    "procedimiento"	=> $post['procedimiento'],
                    "numProcedimiento"	=> $post['numProcedimiento'],
                    "anioProcedimiento"	=> $post['anioProcedimiento'],

    
                );

                $_SESSION['respaldoSolicitud'] = $_SESSION['solicitudActual'];

                $this->query('SELECT * FROM item WHERE idSolicitud="'.$_SESSION['solicitudActual']['id'].'"');
                $_SESSION['items'] = $this->resultSet();

                header('Location: '.ROOT_URL.'solicitudes/verSolicitud');
            }else{
                Messages::setMsg('Ya existe una solicitud con el SR ingresado', 'error');
            }

            }

            if($post['submit'] == "+"){
                $_SESSION['solicitudActual'] = array(
                    "id"	=> $post['id'],
                    "SR"	=> $post['sr'],
                    "planificado"	=> $post['planificado'],
                    "gastos_inversiones"	=> $post['gastos_inversiones'],
                    "grupoAS"	=> $post['grupoAS'],
                    "artServ"	=> $post['artServ'],
                    "detalle"	=> $post['detalle'],
                    "estado"	=> $post['estado'],
                    "oficinaSolicitante"	=> $post['oficinaSolicitante'],
                    "uo"	=> $post['UO'],
                    "fechaHora"	=> $post['fechaHora'],
                    "costoAprox"	=> $post['costo'],
                    "referente"	=> $post['referente'],
                    "contactoReferente"	=> $post['contactoReferente'],
                    "observaciones"	=> $post['observaciones'],
                    "procedimiento"	=> $post['procedimiento'],
                    "numProcedimiento"	=> $post['numProcedimiento'],
                    "anioProcedimiento"	=> $post['anioProcedimiento'],

    
                );

                
                $this->query('INSERT INTO item(cantidad, unidad, descripcion, idSolicitud, total) VALUES ("'.$post['cant'].'", "'.$post['uni'].'", "'.$post['desc'].'", "'.$_SESSION['solicitudActual']['id'].'", "'.$post['total'].'")');
                $this->execute();

                $this->query('SELECT * FROM item where id = (select max(id) from item)');
                $item = $this->single();

                $e = array(
                    "cantidad"	=> $post['cant'],
                    "unidad"	=> $post['uni'],
                    "descripcion"	=> $post['desc'],
                    "total"	=> $post['total'],
                    "id"	=> $item['id']);
                    
                array_push($_SESSION['items'], $e); 

                header('Location: '.ROOT_URL.'solicitudes/editarSolicitud#cant');
            }

            if($post['submit'] == "×"){

                //echo $post['id1'];
                /*
                $_SESSION['solicitudActual'] = array(
                    "id"	=> $post['id'],
                    "SR"	=> $post['sr'],
                    "planificado"	=> $post['planificado'],
                    "gastos_inversiones"	=> $post['gastos_inversiones'],
                    "grupoAS"	=> $post['grupoAS'],
                    "artServ"	=> $post['artServ'],
                    "detalle"	=> $post['detalle'],
                    "estado"	=> $post['estado'],
                    "oficinaSolicitante"	=> $post['oficinaSolicitante'],
                    "fechaHora"	=> $post['fechaHora'],
                    "costoAprox"	=> $post['costo'],
                    "referente"	=> $post['referente'],
                    "contactoReferente"	=> $post['contactoReferente'],
                    "observaciones"	=> $post['observaciones'],
                    "procedimiento"	=> $post['procedimiento'],
    
                );
*/

                    $this->query('DELETE FROM item WHERE id="'.$post['id1'].'"');
                    $this->execute();
                   // echo $post['id1'];

                    

                    $this->query('SELECT * FROM item WHERE idSolicitud="'.$_SESSION['solicitudActual']['id'].'"');
                    $_SESSION['items'] = $this->resultSet();

                    header('Location: '.ROOT_URL.'solicitudes/editarSolicitud#add');


                
               
            }

            
		

        }

        return $row;  
    }

    public function nuevaSolicitud(){


        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post && $post['submit']){
            if($post['submit'] == "Confirmar"){ 


                $_SESSION['solicitud']['sr'] = $post['sr'];
                $_SESSION['solicitud']['planificado'] = $post['planificado'];
                $_SESSION['solicitud']['gastos_inversiones'] = $post['gastos_inversiones'];
                $_SESSION['solicitud']['grupoAS'] = $post['grupoAS'];
                $_SESSION['solicitud']['artServ'] = $post['artServ'];
                $_SESSION['solicitud']['inputas'] = $post['inputas'];
                $_SESSION['solicitud']['detalle'] = $post['detalle'];
                $_SESSION['solicitud']['oficinaSolicitante'] = $post['oficinaSolicitante'];
                $_SESSION['solicitud']['uo'] = $post['uo'];
                $_SESSION['solicitud']['costo'] = $post['costo'];
                $_SESSION['solicitud']['referente'] = $post['referente'];
                $_SESSION['solicitud']['contactoReferente'] = $post['contactoReferente'];
                $_SESSION['solicitud']['observaciones'] = $post['observaciones'];
                $_SESSION['solicitud']['procedimiento'] = $post['procedimiento'];
                $_SESSION['solicitud']['numProcedimiento'] = $post['numProcedimiento'];
                $_SESSION['solicitud']['anioProcedimiento'] = $post['anioProcedimiento'];

                if($post['gastos_inversiones'] != "0" && $post['planificado'] != "0" && $post['oficinaSolicitante'] != "0" && $post['grupoAS'] != "0" && $post['artServ'] != "" && $post['detalle'] != ""){


                $this->query('SELECT * FROM solicitudescompra WHERE SR = "'. $post['sr'].'"');
                $row = $this->single();


                

                if($row == null || $post['sr'] == ""){

                    $date = new DateTime("now", new DateTimeZone('America/Montevideo') );
                    $fecha = $date->format('Y-m-d H:i:s');


                // $fecha = date('Y-m-d h:i:sa');

                    if($_SESSION['items'] != NULL){


                        $this->query('INSERT INTO solicitudescompra(`SR`, `planificado`, `gastos_inversiones`, `grupoAS`, `artServ`, `detalle`, `estado`, `oficinaSolicitante`, `UO`, `fechaHora`, `costoAprox`, `referente`, `contactoReferente`, `observaciones`, `procedimiento`, `numProc`, `anioProc`) 
                        VALUES(:sr, :planificado, :gastos_inversiones, :grupoAS, :artServ, :detalle, :estado, :oficinaSolicitante, :uo, :fechaHora, :costoAprox, :referente, :contactoReferente, :observaciones, :procedimiento, :numProc, :anioProc)');
                        $this->bind(':sr', $post['sr']);
                        $this->bind(':planificado', $post['planificado']);
                        $this->bind(':gastos_inversiones', $post['gastos_inversiones']);
                        $this->bind(':grupoAS', $post['grupoAS']);
                        $this->bind(':artServ', $post['artServ']);
                        $this->bind(':detalle', $post['detalle']);
                        $this->bind(':estado', 'Pendiente');
                        $this->bind(':oficinaSolicitante', $post['oficinaSolicitante']);
                        $this->bind(':uo', $post['uo']);
                        $this->bind(':fechaHora', $fecha);
                        $this->bind(':costoAprox', $post['costo']);
                        $this->bind(':referente', $post['referente']);
                        $this->bind(':contactoReferente', $post['contactoReferente']);
                        $this->bind(':observaciones', $post['observaciones']);
                        $this->bind(':procedimiento', $post['procedimiento']);
                        $this->bind(':numProc', $post['numProcedimiento']);
                        $this->bind(':anioProc', $post['anioProcedimiento']);


                        $this->execute();

                        $this->query('SELECT * FROM solicitudescompra where id = (select max(id) from solicitudescompra)');
                        $soli = $this->single(); 
                        if($soli['fechaHora'] == $fecha){ //$soli es el ultimo registro de la tabla, que se supone es la solicitud recien creada. Comparando la fechaHora me aseguro que asi sea
                            foreach ($_SESSION['items'] as $item) :
                                $this->query('INSERT INTO item(cantidad, unidad, descripcion, idSolicitud, total) VALUES("'. $item['cantidad'] .'", "'. $item['unidad'] .'", "'. $item['descripcion'] .'", "'. $soli['id'] .'", "'. $item['totalItem'] .'")');
                                $this->execute();
                            endforeach;


                            $this->limpiarMemoria();
                            $_SESSION['alertaSolicitud'] = '1';
                            
                        }

                        

                        
                        


                        header('Location: '.ROOT_URL.'solicitudes/listaSolicitudes');
                    }else{
                        Messages::setMsg('Debe agregar al menos un item', 'error');                    
                    }
            



                }else{
                    Messages::setMsg('Ya existe una solicitud con el SR ingresado', 'error');

                }
            }else{
                Messages::setMsg('Hay campos sin completar', 'error');
            }
            }

           


            if($post['submit'] == "+"){ 
                

                $_SESSION['solicitud']['sr'] = $post['sr'];
                $_SESSION['solicitud']['planificado'] = $post['planificado'];
                $_SESSION['solicitud']['gastos_inversiones'] = $post['gastos_inversiones'];
                $_SESSION['solicitud']['grupoAS'] = $post['grupoAS'];
                $_SESSION['solicitud']['artServ'] = $post['artServ'];
                $_SESSION['solicitud']['inputas'] = $post['inputas'];
                $_SESSION['solicitud']['detalle'] = $post['detalle'];
                $_SESSION['solicitud']['oficinaSolicitante'] = $post['oficinaSolicitante'];
                $_SESSION['solicitud']['uo'] = $post['uo'];
                $_SESSION['solicitud']['costo'] = $post['costo'];
                $_SESSION['solicitud']['referente'] = $post['referente'];
                $_SESSION['solicitud']['contactoReferente'] = $post['contactoReferente'];
                $_SESSION['solicitud']['observaciones'] = $post['observaciones'];
                $_SESSION['solicitud']['procedimiento'] = $post['procedimiento'];
                $_SESSION['solicitud']['numProcedimiento'] = $post['numProcedimiento'];
                $_SESSION['solicitud']['anioProcedimiento'] = $post['anioProcedimiento'];


                

                


                        
                $e = array(
                    "cantidad"	=> $post['cant'],
                    "unidad"	=> $post['uni'],
                    "descripcion"	=> $post['desc'],
                    "totalItem"	=> $post['totalItem']);

                    
                array_push($_SESSION['items'], $e); 

                header('Location: '.ROOT_URL.'solicitudes/nuevaSolicitud#add');


            /*

                $item = array(
                    "cantidad" => $post['cant'],
                    "unidad" => $post['uni'],
                    "descripcion" => $post['desc']

                );

                array_push($_SESSION['items'], $e);


 */

 
                 
             }

             if($post['submit'] == "×"){
                /*
                $_SESSION['solicitud']['sr'] = $post['sr'];
                $_SESSION['solicitud']['planificado'] = $post['planificado'];
                $_SESSION['solicitud']['gastos_inversiones'] = $post['gastos_inversiones'];
                $_SESSION['solicitud']['grupoAS'] = $post['grupoAS'];
                $_SESSION['solicitud']['artServ'] = $post['artServ'];
                $_SESSION['solicitud']['inputas'] = $post['inputas'];
                $_SESSION['solicitud']['detalle'] = $post['detalle'];
                $_SESSION['solicitud']['oficinaSolicitante'] = $post['oficinaSolicitante'];
                $_SESSION['solicitud']['costo'] = $post['costo'];
                $_SESSION['solicitud']['referente'] = $post['referente'];
                $_SESSION['solicitud']['contactoReferente'] = $post['contactoReferente'];
                $_SESSION['solicitud']['observaciones'] = $post['observaciones'];
                $_SESSION['solicitud']['procedimiento'] = $post['procedimiento'];
                $_SESSION['solicitud']['numProcedimiento'] = $post['numProcedimiento'];
                $_SESSION['solicitud']['anioProcedimiento'] = $post['anioProcedimiento']; */

                /*
                $array = $_SESSION['items'];
                array_splice($_SESSION['items'], $post['index'], 1, $array); 
                $_SESSION['items'] = $array;*/

                array_splice($_SESSION['items'], $post['index'], 1); 

             }

            }

           
            $this->query('SELECT * FROM oficinas');
            $row = $this->resultSet();
            //$this->query('SELECT * FROM oficinasolicitante');
            //$row['comprobarSR'] = $this->resultSet();
            return $row;


    }

    public function subirArchivos(){
        $this->query('SELECT count(*) FROM archivossolicitudes WHERE idSolicitud = "'. $_SESSION['solicitudActual']['id'] .'"');
        $cantidadAntes = $this->single();

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        for($i=0; $i<sizeof($post['pdf']); $i++){
            $this->query('INSERT INTO archivosSolicitudes(`idSolicitud`, `nombre`, `pdf`) VALUES(:idSolicitud, :nombre, :pdf)');
            $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
            $this->bind(':nombre', $post['pdfnombre'][$i]);
            $this->bind(':pdf', $post['pdf'][$i]);
            $this->execute();
            
        }

        $this->query('SELECT count(*) FROM archivossolicitudes WHERE idSolicitud = "'. $_SESSION['solicitudActual']['id'] .'"');
        $cantidadDespues = $this->single();

        if($cantidadDespues['count(*)'] > $cantidadAntes['count(*)']){
            $_SESSION['alertAddFile'] = '1';
        }else{
            $_SESSION['alertAddFile'] = '0';
        }
        
        
        header('Location: '.ROOT_URL.'solicitudes/verSolicitud');


    }

    public function obtener ($idpdf){
        $this->query('SELECT * FROM archivosSolicitudes WHERE id = :id');
        $this->bind(':id', $idpdf);
        $row = $this->single();
        $pdf = base64_decode($row['pdf']);
        $row['pdflegible'] = $pdf;
        return $row;
    }


  

    public function verArchivo(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->query('SELECT * FROM archivosSolicitudes WHERE id = :id');
        $this->bind(':id', $post['id']);
        $row = $this->single();
        $pdf = base64_decode($row['pdf']);
        $row['pdflegible'] = $pdf;
        return $row;
    }
  

    public function eliminarArchivo(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->query('DELETE FROM archivosSolicitudes WHERE id = :id');
        $this->bind(':id', $post['id']);
        $this->execute();
        $_SESSION['alertDeleteFile'] = "1";
        header('Location: '.ROOT_URL.'solicitudes/verSolicitud#files');
    }

   

 
    public function limpiarMemoria(){
        
        unset($_SESSION['solicitud']['sr']);
        unset($_SESSION['solicitud']['planificado']);
        unset($_SESSION['solicitud']['gastos_inversiones']);
        unset($_SESSION['solicitud']['grupoAS']);
        unset($_SESSION['solicitud']['artServ']);
        unset($_SESSION['solicitud']['inputas']);
        unset($_SESSION['solicitud']['detalle']);
        unset($_SESSION['solicitud']['oficinaSolicitante']);
        unset($_SESSION['solicitud']['uo']);
        unset($_SESSION['solicitud']['costo']);
        unset($_SESSION['solicitud']['referente']);
        unset($_SESSION['solicitud']['contactoReferente']);
        unset($_SESSION['solicitud']['observaciones']);
        unset($_SESSION['solicitud']['procedimiento']);
        unset($_SESSION['solicitud']['numProcedimiento']);
        unset($_SESSION['solicitud']['anioProcedimiento']);

}
 
        

}