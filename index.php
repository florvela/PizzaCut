<?php
	require_once "./MVC/Controller/DBManager.php";
	require_once "./Utils/php/configuracion.php";
	require_once "./MVC/Model/Classes/Usuario.php";
	
	if(isset($_POST['login_field-btn']))
	{
		$umail = $_POST['umail'];
		$upass = $_POST['upass'];
		$user = new USER();
		$rta = $user->login($umail,$upass);
		if($rta!=NULL){
			$_SESSION["user"] = $rta[0]->getIdCuenta();
			if($rta[0]->getIdTipoCuenta()=="2" || $rta[0]->getIdTipoCuenta()=="3"){
				header("Location: MVC/View/Views_php/mainadmin.php");
			} else {
				header("Location: MVC/View/Views_php/main.php");
			}
			
		} else {
			echo "usuario o contrasenia no validos";
		}
	}

	if(isset($_POST['registration-btn'])){
	   $fname = trim($_POST['fname']);
	   $lname = trim($_POST['lname']);
	   $umail = trim($_POST['umail']);
	   $upass = trim($_POST['upass']);
	   $utel = trim($_POST['utel']);
	   $udir = trim($_POST['udir']); 
	 
	   if($fname=="") {
	      	$error[] = "Ingresá tu nombre xd"; 
	   }
	   else if($lname ==""){
	   		$error[] = "Ingresá tu apellido motherfuc%#!@";
	   }
	   else if($umail=="") {
	      	$error[] = "Necesitamos un email sorete"; 
	   }
	   else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
	      $error[] = 'Dale.. Me estas jodiendo?';
	   }
	   else if($upass=="") {
	      $error[] = "Y la contra?";
	   }
	   else if(strlen($upass) < 6){
	      $error[] = "Tiene que ser mayor a 6 we"; 
	   }
	   else{
			$user = new USER();
			$array=$user->register($_POST);
			if($array="guardado"){
				$rta=$user->login($_POST['umail'],$_POST['upass']);
				if($_SESSION["id_cuenta"]!=null){
					header("Location: MVC/View/Views_php/main.php");
				}
				else{
					echo "error, usuario no valido";
				}
			}
			else{
				"no se pudo crear cuenta";
			}
	  	} 
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Iniciar sesion | Pizza Cut</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="Utils/css/login.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="Utils/css/header.css">
	</head>
	<body id="loginHtml">
		<header class="menu_bar">
			<img src="Utils/imgs/logo.png" class="menu_bar-img">
		</header>
		<section class="registration_field">
			<a href="#" class="registration_field-login-btn">Iniciar Sesion</a>
			<form class="registration_field-form-fields" method="post">
				<?php
		            if(isset($error))
		            {
		                  ?>
		                  <div class="alert alert-danger">
		                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
		                  </div>
		                  <?php
		            }
	            ?>
				<input type="email" name="umail" class="registration_field-login-textarea" placeholder="Email">
				<input type="password" name="upass" class="registration_field-login-textarea" placeholder="Contraseña">
				<input type="submit" value="Entrar" name="login_field-btn" class="registration_field-btn">
			</form>

			<a href="#" class="registration_field-signup-btn">Registrarse</a>
			<form class="registration_field-form-fields" method="post">
				<?php
	            if(isset($error))
	            {
	               foreach($error as $error)
	               {
	                  ?>
	                  <div class="alert alert-danger">
	                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
	                  </div>
	                  <?php
	               }
	            }
	            else if(isset($_GET['joined']))
	            {
	                 ?>
	                 <div class="alert alert-info">
	                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
	                 </div>
	                 <?php
	            }
	            ?>
				<input class="registration_field-signup-textarea" name="fname" placeholder="Nombre">
				<input class="registration_field-signup-textarea" name="lname" placeholder="Apellido">
				<input type="email" class="registration_field-signup-textarea" name="umail" placeholder="Email">
				<input type="password" class="registration_field-signup-textarea" name="upass" placeholder="Contraseña">
				<input type="number" class="registration_field-signup-textarea" name="utel" placeholder="Telefono">
				<input  class="registration_field-signup-textarea" name="udir" placeholder="Direccion">
				<input type="submit" value="Enviar" name="registration-btn" class="registration_field-btn">
			</form>
		</section>
		<footer class="footer">
			<p class="footer-paragraph">2017 © puto el que copia</p>
		</footer>
		<script type="text/javascript" src="MVC/View/Classes_js/LoginForms.js"></script>
		<script type="text/javascript" src="MVC/Controller/Controller.js"></script>
	</body>
</html>