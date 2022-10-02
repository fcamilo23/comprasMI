<?php
class Messages{
	public static function setMsg($text, $type){
		if($type == 'error'){
			$_SESSION['errorMsg'] = $text;
		} else if($type == 'success'){
			$_SESSION['successMsg'] = $text;
		}else if($type == 'warning'){
			$_SESSION['warningMsg'] = $text;
		}else if($type == 'info'){
			$_SESSION['infoMsg'] = $text;
		}
	}

	public static function display(){

		if(isset($_SESSION['errorMsg'])){
			echo '<div class="alert alert-danger alert-dismissible fade show">
			<strong>Error! </strong>'.$_SESSION['errorMsg'].'
			</div>';


			unset($_SESSION['errorMsg']);
		}

		if(isset($_SESSION['successMsg'])){
			echo '<div class="alert alert-success alert-dismissible fade show">
			<strong>Success! </strong>'.$_SESSION['successMsg'].'
			</div>';
			unset($_SESSION['successMsg']);
		}

		if(isset($_SESSION['warningMsg'])){
			echo '<div class="alert alert-warning alert-dismissible fade show">
			<strong>Warning! </strong>'.$_SESSION['warningMsg'].'
			</div>';
			unset($_SESSION['warningMsg']);
		}

		
	}
}