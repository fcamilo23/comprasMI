<?php
class ProveedorModel extends Model{
	public function listaProveedores(){
        $this->query('SELECT * FROM proveedores ORDER BY empresa ASC');
        $lstProveedores = $this->resultSet();
       // $_SESSION['proveedoresExcel'] = $lstProveedores;
        return $lstProveedores;

    }

    public function seleccionarProveedor(){
        ///
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($post && $post['submit']){
            if($post['id'] != ''){
                $_SESSION['proveedorActual'] = $post['id'];
            }
        }
        header('Location: '.ROOT_URL.'proveedor/verProveedor');

    }

    public function agregarProveedor(){

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        /// controlar si al menos tiene o nombre o razon social o rut
        if($post['empresa'] == '' && $post['razon_social'] == '' && $post['rut'] == ''){
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'El campo nombre del Referente no puede estar vacio';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
        }else{
            try{
                $this->query('INSERT INTO proveedores (empresa, razon_social, rut, telefono, email) VALUES(:empresa, :razon_social, :rut, :telefono, :email)');
                $this->bind(':empresa', $post['empresa']);
                $this->bind(':razon_social', $post['razon_social']);
                $this->bind(':telefono', $post['telefono']);
                $this->bind(':email', $post['email']);
                $this->bind(':rut', $post['rut']);
                $this->execute();

            }catch(PDOException $e){
                $_SESSION['mensaje']['tipo'] = 'error';
                $_SESSION['mensaje']['contenido'] = 'Error al agregar el proveedor';
                header('Location: '.ROOT_URL.'proveedor/listaProveedores'); 
            }
            if ($this->lastInsertId()){
                $this->query('SELECT * FROM proveedores WHERE id = :id AND empresa = :empresa AND razon_social = :razon_social AND rut = :rut AND telefono = :telefono AND email = :email');
                $this->bind(':id', $this->lastInsertId());
                $this->bind(':empresa', $post['empresa']);
                $this->bind(':razon_social', $post['razon_social']);
                $this->bind(':telefono', $post['telefono']);
                $this->bind(':email', $post['email']);
                $this->bind(':rut', $post['rut']);
                $rows = $this->resultSet();
                if(count($rows) > 0){
                    $_SESSION['proveedorActual']= $rows[0]['id'];
                    header('Location: '.ROOT_URL.'proveedor/verProveedor');
                }else{
                    header('Location: '.ROOT_URL.'proveedor/listaProveedores');
                }
            }
        }
        header('Location: '.ROOT_URL.'proveedor/listaProveedores');
    }

    public function verProveedor (){

        $this->query('SELECT * FROM proveedores WHERE id = :id');
        $this->bind(':id', $_SESSION['proveedorActual']);
        $row = $this->single();
     
        $this->query('SELECT * FROM referentes WHERE idProveedor = :id');
        $this->bind(':id', $_SESSION['proveedorActual']);
        $referentes = $this->resultSet();
        $row['referentes'] = $referentes;
        return $row;
    }

    public function editarReferente(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         if($post['ereferente'] == ''){
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'El campo nombre del Referente no puede estar vacio';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
        }
        try{
            $this->query('UPDATE referentes SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id');
            $this->bind(':nombre', $post['ereferente']);
            $this->bind(':telefono', $post['etelefono']);
            $this->bind(':email', $post['ecorreo']);
            $this->bind(':id', $post['idReferente']);
            $this->execute();
            $_SESSION['mensaje']['tipo'] = 'success';
            $_SESSION['mensaje']['contenido'] = 'Referente editado';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
        }catch(PDOException $e){
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'Error al editar el referente';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
        }
        return;
     }

    public function agregarReferente(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //controlar si el nombre se repite
        $this->query('SELECT * FROM referentes WHERE nombre = :nombre AND idProveedor = :idProveedor');
        $this->bind(':nombre', $post['nreferente']);
        $this->bind(':idProveedor', $_SESSION['proveedorActual']);
        $row = $this->single();

        if($row){
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'El nombre del referente ya existe';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
        }else{
            try{
            $this->query('INSERT INTO referentes (nombre, telefono, email, idProveedor) VALUES(:nombre, :telefono, :email, :idProveedor)');
            $this->bind(':nombre', $post['nreferente']);
            $this->bind(':telefono', $post['ntelefono']);
            $this->bind(':email', $post['ncorreo']);
            $this->bind(':idProveedor', $_SESSION['proveedorActual']);
            $this->execute();
            $_SESSION['mensaje']['tipo'] = 'success';
            $_SESSION['mensaje']['contenido'] = 'Referente agregado';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
            }catch(PDOException $e){
                $_SESSION['mensaje']['tipo'] = 'error';
                $_SESSION['mensaje']['contenido'] = 'Error al agregar el referente';
                header('Location: '.ROOT_URL.'proveedor/verProveedor');
            }
        }
        return;
    }
    
    public function editarProveedor(){
        $this->query('SELECT * FROM proveedores WHERE id = :id');
        $this->bind(':id', $_SESSION['proveedorActual']);
        $row = $this->single();
        return $row;
    }

    public function realizarEditadoProveedor(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($post['empresa'] == ''){
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'El campo empresa no puede estar vacio';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
        }
        try{
            $this->query('UPDATE proveedores SET empresa = :empresa, razon_social = :razon_social, rut = :rut, telefono = :telefono, email = :email WHERE id = :id');
            $this->bind(':empresa', $post['empresa']);
            $this->bind(':razon_social', $post['razon_social']);
            $this->bind(':telefono', $post['telefono']);
            $this->bind(':email', $post['email']);
            $this->bind(':rut', $post['rut']);
            $this->bind(':id', $_SESSION['proveedorActual']);
            $this->execute();
            $_SESSION['mensaje']['tipo'] = 'success';
            $_SESSION['mensaje']['contenido'] = 'Proveedor editado';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
        }catch(PDOException $e){
            $_SESSION['mensaje']['tipo'] = 'error';
            $_SESSION['mensaje']['contenido'] = 'Error al editar el proveedor';
            header('Location: '.ROOT_URL.'proveedor/verProveedor');
        }
    }



    
}

 ?>