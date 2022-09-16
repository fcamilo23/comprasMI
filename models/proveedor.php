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
     
        $this->query('SELECT * FROM referentes WHERE idProveedor = :id');
        $this->bind(':id', $post['id']);
        $referentes = $this->resultSet();
        $row['referentes'] = $referentes;
        return $row;
    }

    public function editarReferente(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         if($post['ereferente'] == ''){
            Messages::setMsg('Debe ingresar un nombre', 'error');
            return;
        }

        $this->query('UPDATE referentes SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id');
        $this->bind(':nombre', $post['ereferente']);
        $this->bind(':telefono', $post['etelefono']);
        $this->bind(':email', $post['ecorreo']);
        $this->bind(':id', $post['idReferente']);
        $this->execute();

        return;
     }

    public function agregarReferente(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //controlar si el nombre se repite
        $this->query('SELECT * FROM referentes WHERE nombre = :nombre');
        $this->bind(':nombre', $post['nreferente']);
        $row = $this->single();

        if($row){
            Messages::setMsg('El referente ya existe', 'error');
            return;
        }
        

        $this->query('INSERT INTO referentes (nombre, telefono, email, idProveedor) VALUES(:nombre, :telefono, :email, :idProveedor)');
        $this->bind(':nombre', $post['nreferente']);
        $this->bind(':telefono', $post['ntelefono']);
        $this->bind(':email', $post['ncorreo']);
         $this->bind(':idProveedor', $post['id']);
        $this->execute();

        return;
    }

    public function editarProveedor(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($post['empresa'] == ''){
            Messages::setMsg('Campo Nombre de la Empresa vacio', 'error');
            return;
        }

        $this->query('UPDATE proveedores SET empresa = :empresa, razon_social = :razon_social, rut = :rut, telefono = :telefono, email = :email WHERE id = :id');
        $this->bind(':empresa', $post['empresa']);
        $this->bind(':razon_social', $post['razon_social']);
        $this->bind(':telefono', $post['telefono']);
        $this->bind(':email', $post['email']);
        $this->bind(':rut', $post['rut']);
        $this->bind(':id', $post['id']);
        $this->execute();

        return;

    }



    
}

 ?>