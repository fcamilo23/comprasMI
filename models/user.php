<?php
// session_start();
class UserModel extends Model{
		
	public function register(){
		// Sanitize POST
		
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post && $post['submit']){
			//$password = md5($post['password']);
			require './assets/utils/mail.php';
			
			if($post['cedula'] == '' || $post['email'] == '' || $post['nombre'] == '' || $post['apellido'] == ''){
				Messages::setMsg('Por favor complete todos los campos', 'error');
				return;
			}

			$this->query('SELECT * FROM Usuarios WHERE cedula = :cedula');
			$this->bind(':cedula', $post['cedula']);
			$row = $this->single();
			
			if($row){
				Messages::setMsg('El usuario ya existe', 'error');
			}
			else {
				$codigo = strval(rand(1111, 1000000));
				$password = md5($codigo);
				$habilitado = 0;
				// Insert into MySQL
				$this->query('INSERT INTO usuarios(cedula, email, nombre, apellido, habilitado, password, codigo, rol) VALUES(:cedula, :email, :nombre, :apellido, :habilitado, :password, :codigo, :rol)');
				$this->bind(':cedula', $post['cedula']);
				$this->bind(':email', $post['email']);
				$this->bind(':nombre', $post['nombre']);
				$this->bind(':apellido', $post['apellido']);
				$this->bind(':habilitado', $habilitado);
				$this->bind(':password', $password);
				$this->bind(':codigo', $codigo);
				$this->bind(':rol', $post['rol']);

				$this->execute();
				
				echo sendEmail($post['email'], $codigo);


				
				//header('Location: '.ROOT_URL.'users/setPass');
			}
		}
		return;
	}

	public function setPass(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post && $post['submit']){
			if($post['password1'] == $post['password2']){
				$this->query('UPDATE usuarios SET password = "' . md5($post['password2']) . '" WHERE cedula = "'. $_SESSION['setPass'].'"');
				$this->execute();
				
			}else{
				echo "La contraseña no coincide";
			}
		}
	}

	
	public function listaUsuarios(){
        
        $this->query('SELECT * FROM usuarios');
        $lstUsuarios = $this->resultSet();

       
        return $lstUsuarios;
    }




	public function profile(){
		$n = $_SESSION['user_data']['cedula'];
		$this->query('SELECT * FROM puntuaciones WHERE cedula = "' . $n . '"');
		$row = $this->resultSet();
        

        
		
		return;
	}
	
	public function login(){
		// Sanitize POST

		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post && $post['submit']){
			$password = md5($post['password']);
			
			$password = "";
			if($post['password']){
				$password = md5($post['password']);
			}
			// Compare Login
			$this->query('SELECT * FROM Usuarios WHERE cedula = :cedula AND password = :password');
			$this->bind(':cedula', $post['cedula']);
			$this->bind(':password', $password);
			//$this->bind(':cedula', 'usuario1');
			//$this->bind(':password', '123456');

			$row = $this->single();

			if($row){
				if($row['password'] == md5($row['codigo'])){
				$_SESSION['setPass'] = $post['cedula'];
				header('Location: '.ROOT_URL.'users/setPass');
					
				}else{

				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"cedula"	=> $row['cedula'],
					"email"	=> $row['email'],
					"nombre"	=> $row['nombre'],
					"apellido"	=> $row['apellido'],
					"rol"	=> $row['rol'],
					"reputacion"	=> $row['reputacion'],
					"biografia"	=> $row['biografia'],
					"imagen"	=> $row['imagen']
				);
				?>
					<h1>llegamos aca1</h1>
				<?php
				
				header('Location: '.ROOT_URL.'users/profile');
			}

			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		//return;
	}
	

}