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

    public function pruebaPDF(){

/*
                //subir pdf

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post) && isset($post['upload'])){

        $this->query('INSERT INTO subirPDF(archivo) VALUES("'. $post['pdf'] .'")');
        $this->execute();
*/

    if (isset($_POST['submit'])) {
    $pdf=$_FILES['pdf']['name'];
    $pdf_type=$_FILES['pdf']['type'];
    $pdf_size=$_FILES['pdf']['size'];
    $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
    $pdf_store="pdf/".$pdf;

    move_uploaded_file($pdf_tem_loc,$pdf_store);

    $this->query('INSERT INTO subirpdf(pdf) values("'. $pdf . '")');
    $$this->execute();



  }
         
        return;
    }

    public function verSolicitud(){
        


        return;
        
         
    }


    public function editarSolicitud(){

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
				$this->bind(':estado', 'Pendiente');
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

        return;  
    }

    public function nuevaSolicitud(){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post && $post['submit']){

            $this->query('SELECT * FROM solicitudescompra WHERE SR = "'. $post['sr'].'"');
            $row = $this->single();

            if($row == null){
                $email = $_SESSION['user_data']['email'];
                $nombre = $_SESSION['user_data']['nombre'] .' '. $_SESSION['user_data']['apellido'];

                $date = new DateTime("now", new DateTimeZone('America/Montevideo') );
                $fecha = $date->format('Y-m-d H:i:s');


               // $fecha = date('Y-m-d h:i:sa');

                $this->query('INSERT INTO solicitudescompra(`SR`, `planificado`, `gastos_inversiones`, `grupoAS`, `artServ`, `detalle`, `cantidad`, `estado`, `oficinaSolicitante`, `fechaHora`, `costoAprox`, `referente`, `contactoReferente`, `observaciones`, `procedimiento`) 
                VALUES(:sr, :planificado, :gastos_inversiones, :grupoAS, :artServ, :detalle, :cantidad, :estado, :oficinaSolicitante, :fechaHora, :costoAprox, :referente, :contactoReferente, :observaciones, :procedimiento)');
                $this->bind(':sr', $post['sr']);
				$this->bind(':planificado', $post['planificado']);
                $this->bind(':gastos_inversiones', $post['gastos_inversiones']);
				$this->bind(':grupoAS', $post['grupoAS']);
				$this->bind(':artServ', $post['grupoAS']);
				$this->bind(':detalle', $post['detalle']);
				$this->bind(':cantidad', $post['cantidad']);
				$this->bind(':estado', 'Pendiente');
				$this->bind(':oficinaSolicitante', 1);
				$this->bind(':fechaHora', $fecha);
				$this->bind(':costoAprox', $post['costo']);
				$this->bind(':referente', $nombre);
				$this->bind(':contactoReferente', $email);
                $this->bind(':observaciones', $post['observaciones']);
				$this->bind(':procedimiento', $post['procedimiento']);

                $this->execute();

                header('Location: '.ROOT_URL.'solicitudes/listaSolicitudes');
		



            }else{
                echo "Ya existe solicitud sr";
            }
        }

        return;
    }
 
        

    
}