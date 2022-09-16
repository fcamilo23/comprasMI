<?php
class OficinaModel extends Model{
	public function listaOficinas(){
        $this->query('SELECT * FROM oficinas');
        $lstOficinas = $this->resultSet();
        return $lstOficinas;
    }

    public function gestorOficina (){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //PARA EDITAR
        if($post['accion'] == 'editar'){
            if($post['eid'] != '' && $post['eue'] != ''){
                
                $this->query('UPDATE oficinas SET  ue = :ue WHERE unidad = :unidad');
                $this->bind(':ue', $post['eue']);
                $this->bind(':unidad', $post['eid']);
                $this->execute();
                
                $this->query('SELECT * FROM oficinas WHERE unidad = :unidad AND ue = :ue' );
                $this->bind(':ue', $post['eue']);
                $this->bind(':unidad', $post['eid']);
                $this->execute();
                $row = $this->single();
                if($row){
                    Messages::setMsg('Oficina actualizada', 'success');
                    return;
                }
            }else{
                Messages::setMsg('Nombre de la Oficina vacio', 'error');
                return;
            }
        }
        //PARA CREAR UNA OFICINA NUEVA
            if($post['accion'] == 'nuevo'){
                if($post['nid'] != '' && $post['nue'] != ''){
                    $this->query('SELECT * FROM oficinas WHERE unidad = :unidad');
                    $this->bind(':unidad', $post['nid']);
                    $this->execute();
                    $row = $this->single();
                    if($row){
                        Messages::setMsg('Ya existe una Oficina con ese id', 'error');
                        return;
                    }
                    $this->query('INSERT INTO oficinas (unidad, ue) VALUES (:unidad, :ue)');
                    $this->bind(':unidad', $post['nid']);
                    $this->bind(':ue', $post['nue']);
                    $this->execute();

                    $this->query('SELECT * FROM oficinas WHERE unidad = :unidad');
                    $this->bind(':unidad', $post['nid']);
                    $this->execute();
                    $row = $this->single();
                    if($row){
                        Messages::setMsg('Ingresada Correctamente', 'success');
                        return;
                    }

                    
                }else{
                    Messages::setMsg('Dejo al menos un campo vacio', 'error');
                    return;
                }
            
            }
    }   


    
}

 ?>
        

    