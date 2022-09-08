<?php
// session_start();
class UserModel extends Model{
		
	public function register(){
		// Sanitize POST
		
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post && $post['submit']){
			$password = md5($post['password']);
			require './assets/utils/mail.php';
			
			if($post['cedula'] == '' || $post['email'] == '' || $post['password'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}

			$this->query('SELECT * FROM Usuarios WHERE email = :email AND password = :password');
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			$row = $this->single();
			
			if($row){
				Messages::setMsg('El usuario ya existe', 'error');
			}
			else {
				$codigo = strval(rand(1111, 1000000));
				$habilitado = 0;
				// Insert into MySQL
				$this->query('INSERT INTO usuarios(cedula, email, nombre, apellido, habilitado, password, codigo) VALUES(:cedula, :email, :nombre, :apellido, :habilitado, :password, :codigo)');
				$this->bind(':cedula', $post['cedula']);
				$this->bind(':email', $post['email']);
				$this->bind(':nombre', $post['nombre']);
				$this->bind(':apellido', $post['apellido']);
				$this->bind(':habilitado', $habilitado);
				$this->bind(':password', $password);
				$this->bind(':codigo', $codigo);
				$this->execute();
				$_SESSION['verifyEmail'] = $post['email'];
				echo sendEmail($post['email'], $codigo);


				
				header('Location: '.ROOT_URL.'users/verifyEmail');
			}
		}
		return;
	}

	public function verifyEmail(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post && $post['submit']){
			$this->query('SELECT * FROM Usuarios WHERE email = :email AND codigo = :codigo');
			$this->bind(':email', $_SESSION['verifyEmail']);
			$this->bind(':codigo',  $post["codigo"]);
			$row = $this->single();
			if($row){
				$this->query('UPDATE Usuarios SET habilitado = 1 WHERE email = :email');
				$this->bind(':email', $_SESSION['verifyEmail']);
				$this->execute();
				//$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"cedula"	=> $row['cedula'],
					"email"	=> $row['email']
				);
				
				header('Location: '.ROOT_URL.'home');

			} else {
				Messages::setMsg('Incorrect cypher', 'error');
			}
		}

		else{
			return;
		}
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
			$this->query('SELECT * FROM Usuarios WHERE cedula = :cedula AND password = :password AND habilitado = true');
			$this->bind(':cedula', $post['cedula']);
			$this->bind(':password', $password);
			//$this->bind(':cedula', 'usuario1');
			//$this->bind(':password', '123456');

			$row = $this->single();

			if($row){
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

			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		//return;
	}
	

}