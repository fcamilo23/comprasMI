<?php
class OficinaModel extends Model{
	public function listaOficinas(){
        $this->query('SELECT * FROM oficinas');
        $lstOficinas = $this->resultSet();
       // $_SESSION['oficinasExcel'] = $lstOficinas;
        return $lstOficinas;
    }

    
}

 ?>
        

    