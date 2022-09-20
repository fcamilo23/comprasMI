<?php
class OrdenModel extends Model{
    public function nuevaOrden(){
        //obtener los proovedores
        $this->query('SELECT id, empresa, razon_social, rut FROM proveedores');
        $lstProveedores = $this->resultSet();
         return $lstProveedores;
    }
}
?>