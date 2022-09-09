<?php
class SolicitudesModel extends Model{
	public function listaSolicitudes(){
        
        $this->query('SELECT * FROM solicitudescompra');
        $lstSolicitudes = $this->resultSet();
        $_SESSION['solicitudesExcel'] = $lstSolicitudes;
       
        return $lstSolicitudes;
    }

    public function downloadFile(){
        
         
        return;
    }
 
        

    
}