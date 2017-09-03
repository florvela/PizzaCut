<?php
	require_once "../../Controller/DBManager.php";
	require_once "../../../Utils/php/configuracion.php";
	require_once "../../Model/Classes/Usuario.php";
	require_once "../../Model/Classes/delete_ADMIN.php";
	require_once "../../Model/Classes/insert_ADMIN.php";
	require_once "../../Model/Classes/update_ADMIN.php";
	$user = new USER();
	$users = $user->all();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/micuentadmin.css">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/header.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../../../Utils/css/Fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<title>Pizza Cut</title>
</head>
<body id="micuentaadminHtml">
	<header class="menu_bar">
		<i id="mobile_bars" class="fa fa-bars fa-2x" aria-hidden="true"></i>
		<a href="mainadmin.php" class="menu_bar-link">Pedidos</a>
		<a href="editarmenu.php" class="menu_bar-link">Editar Menu</a>
		<a href="#" class="selected menu_bar-link">Mi cuenta</a>
	</header>
	<section class="side">
		<i class="fa fa-address-card-o" aria-hidden="true"></i>
		<a href="#" class="side-links">Editar Perfil</a><br>
		<i class="fa fa-users" aria-hidden="true"></i>
		<a href="#" class="side-links">Ver Cuentas Admin.</a><br>
		<i class="fa fa-user-plus" aria-hidden="true"></i>
		<a href="#" class="side-links">Registrar Cuenta Admin.</a><br>
		<i class="fa fa-sign-out" aria-hidden="true"></i>
		<a href="" class="side-links">Cerrar Sesion</a><br>
	</section>
	<section class="side-form">
		<form class="side-form_fields" method="POST">
			<input class="side-form_fields-textarea" name="new_name" placeholder=<?=$fila["nombre"]?>>
			<input class="side-form_fields-textarea" name="new_lname" placeholder=<?=$fila["apellido"]?>>
			<input type="email" class="side-form_fields-textarea" name="new_mail" placeholder=<?=$fila["email"]?>>
			<input type="password" class="side-form_fields-textarea" name="new_pass" placeholder="Contraseña">>
			<input type="submit" value="guardar cambios" class="side-form-btn" id="savebtn" name="updated">
		</form>
	</section>
	<section class="side-form-new_admin">
		<form class="side-form-new_admin_fields" method="POST">
			<input class="side-form_fields-textarea"  name="admin_name" placeholder="Nombre">
			<input class="side-form_fields-textarea" name="admin_lastname"  placeholder="Apellido">
			<input type="email" class="side-form_fields-textarea" name="admin_mail" placeholder="Email">
			<input type="password" class="side-form_fields-textarea" name="admin_pass" placeholder="Contraseña">
			<input type="submit" value="registrar administrador" name="insert_admin" class="side-form-btn">
		</form>
	</section>
	<section class="side-form-admins">
		<form method="POST">
			<table class="side-admin_table-header">
				<tr class="side-admin_table-row--header">
			    	<th id="current-col0">Nombre</th>
			    	<th id="current-col1">Apellido</th> 
			    	<th id="current-col2">Email</th>
			    	<th id="current-col3">Eliminar</th>
			 	</tr>
			 </table>
			<table class="side-admin_table">
				<?php
					foreach ($users as $filas) {
						if($filas->getIdTipoCuenta() == "2"){
				?>
			  	<tr class="side-admin_table-row">
			   		<td id="current-col0"><?= $filas->getNombre()?></td>
			    	<td id="current-col1"><?= $filas->getApellido()?></td> 
			    	<td id="current-col2"><?= $filas->getMail()?></td>
			    	<td id="current-col3"><input type="checkbox" name="checkDel[]" value=<?= $filas->getIdCuenta()?> ></td>
			 	</tr>
			 	<?php }}?>
			 	<tr class="side-admin_table-row" style="display: none;">
			   		<td id="current-col0"></td>
			    	<td id="current-col1"></td> 
			    	<td id="current-col2"></td>
			    	<td id="current-col3"><input type="checkbox" name="checkDel[]" value=<?= $filas->getIdCuenta()?> ></td>
			 	</tr>
			</table>
			<input type="submit" class="side-admin_delete-btn" name="Eliminar_usr-btn" value="Eliminar">
		</form>
	</section>
	<footer class="footer">
		<img src="../../../Utils/imgs/logo.png" alt="" class="footer-img">
		<p class="footer-paragraph">2017 © puto el que copia</p>
	</footer>
	<script type="text/javascript" src="../Classes_js/Profile.js"></script>
	<script type="text/javascript" src="../Classes_js/ToggleHeader.js"></script>
	<script type="text/javascript" src="../../Controller/Controller.js"></script>
</body>
</html>