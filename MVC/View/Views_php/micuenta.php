<?php
	require_once "../../../Utils/php/configuracion.php";
	require_once "../../Model/Classes/update_USER.php";
	if(isset($_GET['clickk'])){
		$user->logout();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/micuenta.css">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/header.css">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Google API para Google Maps -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- barras de menu para celular -->
	<link rel="stylesheet" href="../../../Utils/css/Fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<title>Pizza Cut</title>
</head>
<body id="micuentaHtml">
	<img src="../../../Utils/imgs/mainpizza.jpg" class="background_img">

	<header class="menu_bar">
		<i id="mobile_bars" class="fa fa-bars fa-2x" aria-hidden="true"></i>
		<div class="menu_bar-link">Tu opinion!</div>
		<form method="POST" class="menu_bar-form">
			<textarea maxlength="250" class="menu_bar-link-textarea" placeholder="Compartinos tu opinion..."></textarea>
			<button type="submit" class="menu_bar-link-btn">Enviar</button>
		</form>
		<a href="contactenos.php" class="menu_bar-link">Contactenos</a>
		<a href="ayuda.php" class="menu_bar-link">Ayuda</a>
		<a href="#" class="selected menu_bar-link">Mi Cuenta</a>	
		<a href="main.php" class="menu_bar-link">Pedidos</a>
	</header>

	<section class="side">
		<i class="fa fa-address-card-o" aria-hidden="true"></i>
		<a href="#" class="side-links">Editar Perfil</a><br>
		<br>
		<i class="fa fa-sign-out" aria-hidden="true"></i>

		<a href="cuenta.logout.php" class="side-links">Cerrar Sesion</a><br>
	</section>
	<section class="side-form">
		<form class="side-form_fields" method="POST">
			<input class="side-form_fields-textarea" name="new_name" placeholder=<?=$fila['nombre']?>>
			<input class="side-form_fields-textarea" name="new_lname" placeholder=<?=$fila['apellido']?>>
			<input  class="side-form_fields-textarea" name="new_direc" placeholder=<?=$fila['direccion']?>>
			<input type="email" class="side-form_fields-textarea" name="new_mail" placeholder=<?=$fila['email']?>>
			<input type="password" class="side-form_fields-textarea" name="new_pass" placeholder="Contraseña">
			<input type="number" class="side-form_fields-textarea" name="new_tel" placeholder=<?=$fila['telefono']?>>
			<input type="submit" value="guardar cambios" class="side-form-btn" id="savebtn" name="updated">
			<input type="submit" value="eliminar cuenta" class="side-form-btn" name="delete_cuenta" onclick="return confirm('Are you sure?');">
		</form>
	</section>

	<!-- footer -->

	<footer class="footer">
		<img src="../../../Utils/imgs/logo.png" alt="" class="footer-img">
		<p class="footer-paragraph">2017 © puto el que copia</p>
	</footer>

	<!-- scripts -->
	<script type="text/javascript" src="../Classes_js/SideForm.js"></script>
	<script type="text/javascript" src="../Classes_js/OpinionForm.js"></script>
	<!-- controller -->
	
	<script type="text/javascript" src="../Classes_js/ToggleHeader.js"></script>
	<script type="text/javascript" src="../../Controller/Controller.js"></script>
</body>
</html>