
<?php 


class HomeModel extends Model{
	public function index(){

	
        $this->query('SELECT * FROM `itemOrden` 
                    JOIN ordenes ON itemOrden.idOrden = ordenes.id
                    WHERE ordenes.estado="activo" AND (esservicio = "General" OR esservicio="Licencia") and itemOrden.fin >= (select curdate()) ORDER BY itemOrden.fin ASC limit 10');
        $row = $this->resultSet();

        return $row;
		
		
	}



	
}