<?php
	require_once "../../Controller/DBManager.php";
	require_once "../../../Utils/php/configuracion.php";
	require_once "../../Model/Classes/Pedido.php";

	$pedidos = new Pedido();
	$pedidos_arr = $pedidos->all();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/mainadmin.css">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/header.css">
	<link rel="stylesheet" href="../../../Utils/css/Fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Pizza Cut</title>
</head>
<body id="mainadminHtml">
	<header class="menu_bar">
		<i id="mobile_bars" class="fa fa-bars fa-2x" aria-hidden="true"></i>
		<a href="#" class="selected menu_bar-link">Pedidos</a>
		<a href="editarmenu.php" class="menu_bar-link">Editar Menu</a>
		<a href="micuentadmin.php" class="menu_bar-link">Mi cuenta</a>
	</header>
	<section class="pedidos">
		<div class="table_header">
			<h2 class="table_header--h2">Nº Pedido</h2>
			<h2 class="table_header--h2">Pedido</h2>
			<h2 class="table_header--h2">Direccion</h2>
			<h2 class="table_header--h2">Monto</h2>
			<h2 class="table_header--h2">Estado</h2>
		</div>
		<form method="POST" class="table_pedidos">
			<table class="table_pedidos_actuales" >
				<?php 

					function cmp($a, $b)
					{
					    return strtotime($a->getdatetime_p())<strtotime($b->getdatetime_p())?1:-1;
					}

					uasort($pedidos_arr, "cmp");

					foreach ($pedidos_arr as $fila){
						//$fila->update_state($fila->getidpedido(),"Confirmado");
						if($fila->getitems_arr()!= NULL){
						
				?>
				<tr class="table_pedidos_actuales-row" >
					<td class="table_pedidos_actuales-column"><?= $fila->getidpedido()?>
					</td>
					<td class="table_pedidos_actuales-column">
						<p> <?= $fila->getdatetime_p()?> </p>
						<?php  
							echo ($fila->getitems_arr()); 
							foreach ($fila->getitems_arr() as $item) {
						?>
						<p><?= $item?></p>
						<?
							}
						?>
					</td>
					<td class="table_pedidos_actuales-column"><?= $fila->getdireccion()?></td>
					<td class="table_pedidos_actuales-column"><?= "$" . $fila->getprecio_pagar()?></td>
					<td class="table_pedidos_actuales-column">
						<select class="table_pedidos_actuales-column-status" id="statusOption" name="statusOption">
							<?php
							$estado = $fila->getdescripcion_estados();
							switch($estado){
								case "Sin Confirmar":
								//usuario puede cancelar
									echo "<option value='Sin_Confirmar' selected disabled>Sin Confirmar</option>
				  						<option value='Confirmado'>Confirmado</option>
				  						<option value='En_camino'>En Camino</option>
				  						<option value='Completado'>Completado</option>
				  						<option value='Cancelado'>Cancelado</option>";
				  					//$fila->update_state($fila->getidpedido(),"Confirmado");
								break;
								case "Confirmado":
								//usuario puede cancelar
								echo "<option value='Sin_Confirmar' disabled>Sin Confirmar</option>
			  						<option value='Confirmado' selected disabled>Confirmado</option>
			  						<option value='En_camino'>En Camino</option>
			  						<option value='Completado'>Completado</option>
			  						<option value='Cancelado'>Cancelado</option>";

								break;
								case "En Camino":
								//usuario no puede cancelar
								echo "<option value='Sin_Confirmar' disabled>Sin Confirmar</option>
			  						<option value='Confirmado' disabled>Confirmado</option>
			  						<option value='En_camino' selected disabled>En Camino</option>
			  						<option value='Completado'>Completado</option>
			  						<option value='Cancelado' disabled>Cancelado</option>";
								break;
								case "Completado":
								echo "<option value='Sin_Confirmar' disabled>Sin Confirmar</option>
			  						<option value='Confirmado' disabled>Confirmado</option>
			  						<option value='En_camino' disabled>En Camino</option>
			  						<option value='Completado' selected disabled>Completado</option>
			  						<option value='Cancelado' disabled>Cancelado</option>";
								break;
								case "Cancelado":
								echo "<option value='Sin_Confirmar' disabled>Sin Confirmar</option>
			  						<option value='Confirmado' disabled>Confirmado</option>
			  						<option value='En_camino' disabled>En Camino</option>
			  						<option value='Completado' disabled>Completado</option>
			  						<option value='Cancelado' selected disabled>Cancelado</option>";
								break;
							}			
							?>
						</select>
					</td>
				</tr>
				<tr class="table_pedidos_actuales-row">
				<?php
						}
					}
					
				?>
			</table>
		</form>	
	</section>
	<footer class="footer">
		<img src="../../../Utils/imgs/logo.png" alt="" class="footer-img">
		<p class="footer-paragraph">2017 © puto el que copia</p>
	</footer>
	<script type="text/javascript" src="../../mainadmin.js"></script>
	<script type="text/javascript" src="../Classes_js/ToggleHeader.js"></script>
	<script type="text/javascript" src="../../Controller/Controller.js"></script>
</body>
</html>