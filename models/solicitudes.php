<?php
class SolicitudesModel extends Model{
	public function listaSolicitudes(){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post) && isset($post['submit'])){
            $sr = $post['numero'];
            $this->query('SELECT * FROM solicitudescompra WHERE sr = "'. $sr .'"');
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
                "estado"	=> $row['estado'],
                "oficinaSolicitante"	=> $row['oficinaSolicitante'],
                "fechaHora"	=> $row['fechaHora'],
                "costoAprox"	=> $row['costoAprox'],
                "referente"	=> $row['referente'],
                "contactoReferente"	=> $row['contactoReferente'],
                "observaciones"	=> $row['observaciones'],
                "procedimiento"	=> $row['procedimiento'],

            );

            header('Location: '.ROOT_URL.'solicitudes/verSolicitud');
            

        }
        
        $this->query('SELECT * FROM solicitudescompra');
        $lstSolicitudes = $this->resultSet();
        $_SESSION['solicitudesExcel'] = $lstSolicitudes;
       
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

    public function verSolicitud(){

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

            


                $this->query('UPDATE solicitudescompra SET SR = :sr, planificado = :planificado, gastos_inversiones = :gastos_inversiones, grupoAS=:grupoAS, artServ=:artServ, detalle=:detalle, cantidad=:cantidad, estado=:estado, oficinaSolicitante=:oficinaSolicitante, costoAprox=:costoAprox, referente=:referente, contactoReferente=:contactoReferente, observaciones=:observaciones, procedimiento=:procedimiento WHERE id=:id'); 
                $this->bind(':sr', $post['sr']);
				$this->bind(':planificado', $post['planificado']);
                $this->bind(':gastos_inversiones', $post['gastos_inversiones']);
				$this->bind(':grupoAS', $post['grupoAS']);
				$this->bind(':artServ', $post['grupoAS']);
				$this->bind(':detalle', $post['detalle']);
				$this->bind(':cantidad', $post['cantidad']);
				$this->bind(':estado', $post['estado']);
				$this->bind(':oficinaSolicitante', 1);
				$this->bind(':costoAprox', $post['costo']);
				$this->bind(':referente', $post['referente']);
				$this->bind(':contactoReferente', $post['contactoReferente']);
                $this->bind(':observaciones', $post['observaciones']);
				$this->bind(':procedimiento', $post['procedimiento']);
                $this->bind(':id', $post['id']);


                $this->execute();

                $_SESSION['solicitudActual'] = array(
                    "id"	=> $post['id'],
                    "SR"	=> $post['sr'],
                    "planificado"	=> $post['planificado'],
                    "gastos_inversiones"	=> $post['gastos_inversiones'],
                    "grupoAS"	=> $post['grupoAS'],
                    "artServ"	=> $post['artServ'],
                    "detalle"	=> $post['detalle'],
                    "cantidad"	=> $post['cantidad'],
                    "estado"	=> $post['estado'],
                    "oficinaSolicitante"	=> $post['oficinaSolicitante'],
                    "fechaHora"	=> $post['fechaHora'],
                    "costoAprox"	=> $post['costo'],
                    "referente"	=> $post['referente'],
                    "contactoReferente"	=> $post['contactoReferente'],
                    "observaciones"	=> $post['observaciones'],
                    "procedimiento"	=> $post['procedimiento'],
    
                );

                header('Location: '.ROOT_URL.'solicitudes/verSolicitud');
		

        }

        return $row;  
    }

    public function nuevaSolicitud(){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post && $post['submit']){

            $this->query('SELECT * FROM solicitudescompra WHERE SR = "'. $post['sr'].'"');
            $row = $this->single();

            if($row == null){

                $date = new DateTime("now", new DateTimeZone('America/Montevideo') );
                $fecha = $date->format('Y-m-d H:i:s');


               // $fecha = date('Y-m-d h:i:sa');

                $this->query('INSERT INTO solicitudescompra(`SR`, `planificado`, `gastos_inversiones`, `grupoAS`, `artServ`, `detalle`, `cantidad`, `unidad`, `estado`, `oficinaSolicitante`, `fechaHora`, `costoAprox`, `referente`, `contactoReferente`, `observaciones`, `procedimiento`) 
                VALUES(:sr, :planificado, :gastos_inversiones, :grupoAS, :artServ, :detalle, :cantidad, :unidad, :estado, :oficinaSolicitante, :fechaHora, :costoAprox, :referente, :contactoReferente, :observaciones, :procedimiento)');
                $this->bind(':sr', $post['sr']);
				$this->bind(':planificado', $post['planificado']);
                $this->bind(':gastos_inversiones', $post['gastos_inversiones']);
				$this->bind(':grupoAS', $post['grupoAS']);
				$this->bind(':artServ', $post['grupoAS']);
				$this->bind(':detalle', $post['detalle']);
				$this->bind(':cantidad', $post['cantidad']);
                $this->bind(':unidad', $post['unidad']);
				$this->bind(':estado', 'Pendiente');
				$this->bind(':oficinaSolicitante', 1);
				$this->bind(':fechaHora', $fecha);
				$this->bind(':costoAprox', $post['costo']);
				$this->bind(':referente', $post['referente']);
				$this->bind(':contactoReferente', $post['contactoReferente']);
                $this->bind(':observaciones', $post['observaciones']);
				$this->bind(':procedimiento', $post['procedimiento']);

                $this->execute();

                header('Location: '.ROOT_URL.'solicitudes/listaSolicitudes');
		



            }else{
                echo "Ya existe solicitud sr";
            }
        }

        $this->query('SELECT * FROM oficinas');
        $row = $this->resultSet();
        return $row;
    }

    public function subirArchivos(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        for($i=0; $i<sizeof($post['pdf']); $i++){
            $this->query('INSERT INTO archivosSolicitudes(`idSolicitud`, `nombre`, `pdf`) VALUES(:idSolicitud, :nombre, :pdf)');
            $this->bind(':idSolicitud', $_SESSION['solicitudActual']['id']);
            $this->bind(':nombre', $post['pdfnombre'][$i]);
            $this->bind(':pdf', $post['pdf'][$i]);
            $this->execute();
            
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
        header('Location: '.ROOT_URL.'solicitudes/verSolicitud');
    }

   

 

 
        

    
}