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
				
				sendEmail($post['email'], $codigo);


				
				header('Location: '.ROOT_URL.'');
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
				header('Location: '.ROOT_URL.'users/login');

				
			}else{
				echo "La contraseña no coincide";
			}
		}
	}

	
	public function listaUsuarios(){

		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if(isset($post) && isset($post['submit'])){
				if($post['submit'] == 'Editar'){

					$this->query('SELECT * FROM usuarios WHERE cedula = "'. $post['ciuser'] .'"');
					$_SESSION['usuarioActual'] = $this->single();

					header('Location: '.ROOT_URL.'users/editar');


				}

		}

        
        $this->query('SELECT * FROM usuarios');
        $lstUsuarios = $this->resultSet();

       
        return $lstUsuarios;
    }




	public function profile(){
	
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post) && isset($post['submit'])){

			$_SESSION['usuarioActual'] = $_SESSION['user_data'];
			header('Location: '.ROOT_URL.'users/editar');

		}


        
		
		return;
	}

	public function resetPassword(){
		require './assets/utils/mail.php';
		if(!isset($_SESSION['codigo'])){
			$_SESSION['codigo'] = strval(rand(1111, 1000000));
			//echo $_SESSION['codigo'];
			sendEmailPass($_SESSION['user_data']['email'], $_SESSION['codigo']);
			$_SESSION['enviarCorreoCC'] = '0';
		}else{
			if(isset($_SESSION['reenviar'])){
				$_SESSION['codigo'] = strval(rand(1111, 1000000));
				//echo $_SESSION['codigo'];
				sendEmailPass($_SESSION['user_data']['email'], $_SESSION['codigo']);
				$_SESSION['enviarCorreoCC'] = '0';

				unset($_SESSION['reenviar']);
			}else{
				$_SESSION['noEnviarCorreo'] = '0';
			}

		}

		
	
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post) && isset($post['submit'])){

			
			if($post['code'] != $_SESSION['codigo']){
				Messages::setMsg('El código ingresado no es correcto, intente de nuevo', 'error');

			}else{
				
				$password = md5($post['password1']);
				$this->query('UPDATE usuarios SET password = "'. $password .'" WHERE cedula = "'. $_SESSION['user_data']['cedula'] .'"');
				$this->execute();
				unset($_SESSION['codigo']);

				$_SESSION['mensajePass'] = '1';
				header('Location: '.ROOT_URL.'users/profile');
				unset($_SESSION['codigo']);

			}
			

		}
		echo $_SESSION['codigo'];
		return;
	}



	public function editar(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post) && isset($post['submit'])){
			if($post['submit'] == 'Guardar Cambios'){

				
				$this->query('UPDATE usuarios SET cedula = "'.$post['ci'].'", nombre = "'.$post['nombre'].'", apellido = "'.$post['apellido'].'", email = "'.$post['email'].'", rol = "'.$post['rol'].'" WHERE cedula = "'. $post['ciActual'].'" ');
				$this->execute();

				if($_SESSION['user_data']['cedula'] == $post['ciActual']){
					$_SESSION['user_data']['cedula'] = $post['ci'];
					$_SESSION['user_data']['nombre'] = $post['nombre'];
					$_SESSION['user_data']['apellido'] = $post['apellido'];
					$_SESSION['user_data']['email'] = $post['email'];
					$_SESSION['user_data']['rol'] = $post['rol'];
				}

				header('Location: '.ROOT_URL.'users/listaUsuarios');

			}

			if($post['submit'] == 'Eliminar Usuario'){

				$this->query('DELETE FROM usuarios WHERE cedula = "'.$post['ciActual'].'"');
				$this->execute();

				header('Location: '.ROOT_URL.'users/listaUsuarios');


				
			}

			
		}
        
		
		return;
	}
	
	public function login(){
		// Sanitize POST

		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post && $post['submit']){
			//echo 441;

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
				//echo $post['cedula'];

				if($row['password'] == md5($row['codigo'])){
					
				$_SESSION['setPass'] = $post['cedula'];
				header('Location: '.ROOT_URL.'users/setPass');
					
				}else{
				$_SESSION['actualizarRep'] = '0';
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"cedula"	=> $row['cedula'],
					"email"	=> $row['email'],
					"nombre"	=> $row['nombre'],
					"apellido"	=> $row['apellido'],
					"rol"	=> $row['rol'],
				);
				?>

				<?php
				
				header('Location: '.ROOT_URL.'');
			}

			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		//return;
	}
	

}