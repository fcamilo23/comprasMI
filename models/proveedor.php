<?php
class ProveedorModel extends Model{
	public function listaProveedores(){
        $this->query('SELECT * FROM proveedores');
        $lstProveedores = $this->resultSet();
       // $_SESSION['proveedoresExcel'] = $lstProveedores;
        return $lstProveedores;

    }

    public function agregarProveedor(){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        /// controlar si al menos tiene o nombre o razon social o rut
        if($post['empresa'] == '' && $post['razon_social'] == '' && $post['rut'] == ''){
            Messages::setMsg('Debe ingresar al menos un dato de contacto', 'error');
            return;
        }else
        {

            $this->query('INSERT INTO proveedores (empresa, razon_social, rut, telefono, email) VALUES(:empresa, :razon_social, :rut, :telefono, :email)');
            $this->bind(':empresa', $post['empresa']);
            $this->bind(':razon_social', $post['razon_social']);
            $this->bind(':telefono', $post['telefono']);
            $this->bind(':email', $post['email']);
            $this->bind(':rut', $post['rut']);
            $this->execute();

            if($this->lastInsertId()){
                Messages::setMsg('Proveedor agregado', 'success');
            }
                      
            if($this->lastInsertId()){
                $post['id']= $idProveedor;
                header('Location: '.ROOT_URL.'proveedor/listaProveedores');
            }
        }
        return;
    }

    public function verProveedor (){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->query('SELECT * FROM proveedores WHERE id = :id');
        $this->bind(':id', $post['id']);
        $row = $this->single();
        return $row;
    }
    /*public function verProveedor ($id){

        $this->query('SELECT * FROM proveedores WHERE id = :id');
        $this->bind(':id', $id);
        $row = $this->single();
        return $row;
    }
*/

    
}

 ?>