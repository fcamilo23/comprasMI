<?php
class SolicitudesModel extends Model{
	public function listaSolicitudes(){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post) && isset($post['submit'])){
            $sr = $post['numero'];
            $this->query('SELECT * FROM solicitudescompra WHERE sr = "'. $sr .'"');
            $row = $this->single();


            $_SESSION['solicitudActual'] = array(
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

    public function downloadFile(){
        
         
        return;
    }

    public function verSolicitud(){
        


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
                $fecha = date('Y-m-d h:i:sa');

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