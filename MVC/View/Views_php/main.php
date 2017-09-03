<?php
	require_once "../../Controller/DBManager.php";
	require_once "../../../Utils/php/configuracion.php";
	require_once "../../Model/Classes/Item.php";
	require_once "../../Model/Classes/Pedido.php";
	require_once "../../Model/Classes/Usuario.php";

	$item = new Item();
	$items = $item->all();
	$id = $_SESSION['user'];

	$pedido = new Pedido();
	$cuenta = new USER();
	
	// var_dump($cuenta->getByPk($id));
	try{
		$data = $_POST["pedido"];
		$dataTotal = $_POST["total"];	
	} catch(PDOException $e) {
       echo $e->getMessage();
    } 
	
	
	try{
        $datalenght = count($data);
        $query1 = "INSERT INTO Pedidos ( precio_pagar, idestado_p, idcuenta_p, datetime_p) VALUES (". $dataTotal . ",1," . $id . ",(SELECT NOW()));";
        $stmt = DBcnx::getStatement($query1); 

        $stmt->execute(); 
		      
        for($i = 0; $i<$datalenght; $i++){

        	$query2 = "INSERT INTO Pedidos_has_Items (idpedido_phi, iditem_phi, cantidad, precio_parcial)
			VALUES((SELECT MAX(idpedido) FROM Pedidos WHERE idcuenta_p = ".$id."),". $data[$i][3] .",".$data[$i][0].",".$data[$i][2].");";
        	
        	$stmt2 = DBcnx::getStatement($query2);  
        	$stmt2->execute(); 
        }   
    } catch(PDOException $e) {
       echo $e->getMessage();
    } 
	


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/main.css">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/header.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jquery -->
	<link rel="stylesheet" href="../../../Utils/css/Fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<title>Pizza Cut</title>

</head>
<body id="mainHtml"> <!-- id del body lo utiliza el controller -->
	<div class="blur"></div>
	<header class="menu_bar">
		<i id="mobile_bars" class="fa fa-bars fa-2x" aria-hidden="true"></i>
		<div class="menu_bar-link">Tu opinion!</div>
		<form method="POST" class="menu_bar-form">
			<textarea maxlength="250" class="menu_bar-link-textarea" placeholder="Compartinos tu opinion..."></textarea>
			<button type="submit" class="menu_bar-link-btn">Enviar</button>
		</form>
		<a href="contactenos.php" class="menu_bar-link">Contactenos</a>
		<a href="ayuda.php" class="menu_bar-link">Ayuda</a>
		<a href="micuenta.php" class="menu_bar-link">Mi Cuenta</a>	
		<a href="#" class="selected  menu_bar-link">Pedidos</a>
	</header>


	<section class="ordenes" >
		<form method="POST">
			<h1 class="ordenar-title">Pizzas</h1>
			<div class="ordenar-container">
				<table class="ordenar-menu">
					<?
						foreach ($items as $fila) {
							if($fila->getidtipo_item() == "1"){
								$id = "test" . $fila->getid_item();
					?>
					<tr class="ordenar-menu-row">
						<td class="ordenar-menu-col" id="ordenar-menu-col--0">
							<input type="checkbox" id=<?=$id?> class="ordenar-menu-checkbox"/>
						    <label for=<?=$id?> </label>
						</td>
						<td class="ordenar-menu-col" id="ordenar-menu-col--1">
							<?= $fila->getnombre()?>
						</td>
						<td class="ordenar-menu-col" id="ordenar-menu-col--2">
							<?= $fila->getdescripcion()?>
						</td>
						<td class="ordenar-menu-col" id="ordenar-menu-col--3">
							$<?= $fila->getprecio()?>
						</td>
					</tr>
					<?
							}
						}
					?>
				</table>
			</div>

			

			<h1 class="ordenar-title">Gaseosas</h1>
			<div class="ordenar-container">
				<table class="ordenar-menu">
					<?
						foreach ($items as $fila) {
							if($fila->getidtipo_item() == "2"){
								$id = "test" . $fila->getid_item();	
					?>
					<tr class="ordenar-menu-row">
						<td class="ordenar-menu-col" id="ordenar-menu-col--0">
							<input type="checkbox" id=<?=$id?> class="ordenar-menu-checkbox"/>
						    <label for=<?=$id?>></label>
						</td>
						<td class="ordenar-menu-col" id="ordenar-menu-col--1">
							<?= $fila->getnombre()?>
						</td>
						<td class="ordenar-menu-col" id="ordenar-menu-col--2">
						</td>
						<td class="ordenar-menu-col" id="ordenar-menu-col--3">
							$<?= $fila->getprecio()?>
						</td>
					</tr>
					<?
							}
						}
					?>
				</table>
			</div>
			<div class="ordenar-cantidad">
				<p class="ordenar-paragraph">Cantidad</p>
				<input type="number" name="cantidad" value="1" min="1" max="50" class="ordenar-numero">
				<div class="ordenar-cantidad-check">Agregar</div>
			</div>
			<div class="cart-container">
				<div class="cart" id="cart_id">
					<p class="cart-title">Mi Pedido</p>
					<i id="cart-trash" class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
					<img src="../../../Utils/imgs/pizzaa.png" id="pedidoVacio">
					<p class="pedido-vacio--p">¿Con hambre? <br> Tu pedido está vacío. <br> Selecciona algún item de nuestro menú. </p>
					<table class="cart-table" id="cart-table">
					</table>
					<div class="cart-info">
						<p class="cart-paragraph">Delivery para:</p>
						<textarea class="cart-taxtarea" id="direccion" name="direccion">Cramer 1667</textarea>
						<p class="cart-total--title">Total</p>
						<p class="cart-total--number">$0</p>
					</div>
					<input type="submit" value="Realizar Pedido" class="ordenes-enviar_btn" name="RealizarPedido">
				</div>
			</div>
		</form>

	</section>
	<section class="pedidos" >
		<form method="POST">
			
			<h3 class="pedidos_actuales-title">Pedidos Actuales</h3>
			<table class="pedidos_actuales" >
				<tr class="pedidos_actuales-row--header">
					<th id="current-col0">Cancelar</th>
					<th id="current-col1">Pedido</th>
					<th id="current-col2">Hora de entrega</th>
					<th id="current-col3">Total a pagar</th>
					<th id="current-col4">Estado</th>
				</tr>
				<tr class="pedidos_actuales-row">
					<td class="pedidos_actuales-column">
						<input type="checkbox" id="test9"/>
						<label for="test9"></label>
					</td>
					<td class="pedidos_actuales-column">
						<p class="pedidos-historial-item-paragraph"> 25 may 2017 - 21:43</p>
						<p class="pedidos-historial-item-paragraph">1 Muzzarella</p>
					</td>
					<td class="pedidos_actuales-column"></td>
					<td class="pedidos_actuales-column">$150</td>
					<td class="pedidos_actuales-column">Sin Confirmar</td>
				</tr>
				<tr class="pedidos_actuales-row">
					<td class="pedidos_actuales-column">
						<input type="checkbox" id="test10" />
						<label for="test10"></label>
					</td>
					<td class="pedidos_actuales-column">
						<p class="pedidos-historial-item-paragraph"> 25 may 2017 - 21:41</p>
						<p class="pedidos-historial-item-paragraph">1 Muzzarella</p>
						<p class="pedidos-historial-item-paragraph">1 Fugazzeta</p>
					</td>
					<td class="pedidos_actuales-column">22:00-22:30</td>
					<td class="pedidos_actuales-column">$360</td>
					<td class="pedidos_actuales-column">Confirmado</td>
				</tr>
			</table>
			<input type="button" name="mis_pedidos" value="Ver Historial" class="ordenes-pedidos_btn">
			<div class="pedidos-historial">
				<h3 class="pedidos-historial-title">Historial de pedidos</h3>
				<ul>
					<li class="pedidos-historial-item">
						<p class="pedidos-historial-item-paragraph"> 24 may 2017 - 21:41</p>
						<p class="pedidos-historial-item-paragraph">1 Muzzarella</p>
						<p class="pedidos-historial-item-paragraph">1 Fugazzeta</p>
						<hr>
					</li>
					<li class="pedidos-historial-item">
						<p class="pedidos-historial-item-paragraph">17 may 2017 - 20:05</p>
						<p class="pedidos-historial-item-paragraph">2 Muzzarella</p>
						<p class="pedidos-historial-item-paragraph">1 Coca-Cola 2,5L</p>
						<hr>
					</li>
					<li class="pedidos-historial-item">
						<p class="pedidos-historial-item-paragraph">12 may 2017 - 22:26</p>
						<p class="pedidos-historial-item-paragraph">1 Muzzarella</p>
						<hr>
					</li>
				</ul>
			</div>
		</form>	
	</section>
	<!-- footer -->
	<footer class="footer">
		<img src="../../../Utils/imgs/logo.png" alt="" class="footer-img">
		<p class="footer-paragraph">2017 © puto el que copia</p>
	</footer>

	<!-- scripts -->
	<script type="text/javascript" src="../Classes_js/Pedido.js"></script>
	<script type="text/javascript" src="../Classes_js/OpinionForm.js"></script>
	<script type="text/javascript" src="../Classes_js/ToggleHeader.js"></script>
	<script type="text/javascript" src="../Classes_js/Historial.js"></script>
	<script type="text/javascript" src="../../Controller/Controller.js"></script>
	
</html>