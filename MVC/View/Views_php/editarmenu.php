<?php
	require_once "../../Controller/DBManager.php";
	require_once "../../../Utils/php/configuracion.php";
	require_once "../../Model/Classes/Item.php";
	require_once "../../Model/Classes/delete_ITEM.php";
	require_once "../../Model/Classes/insert_ITEM.php";
	$item = new Item();
	$items = $item->all();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/editarmenu.css">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/header.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../../Utils/css/Fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Pizza Cut</title>
</head>
<body>
	<div class="blur"></div>
	<header class="menu_bar">
		<a href="mainadmin.php" class="menu_bar-link">Pedidos</a>
		<a href="#" class="selected menu_bar-link">Editar Menu</a>
		<a href="micuentadmin.php" class="menu_bar-link">Mi cuenta</a>
		<i id="mobile_bars" class="fa fa-bars fa-2x" aria-hidden="true"></i>
	</header>
	<section class="ordenes">
		<form method="POST" id="insertForm" class="insert_form">
			<input type="textarea" name="itemname" class="insert_form-input" placeholder="Nombre"/><span class="insert_form-error"><?php echo $errEmpty; ?></span>
			<textarea  name = "descripcion" rows="3" col="30" class="insert_form-input" maxlength="255" placeholder="Descripción" form="insertForm" id="insert-textarea"></textarea>
			<input type="textarea" name="price" placeholder="$" class="insert_form-price" ><span class="insert_form-error"><?php echo $errPrice; ?></span>
			<select form="insertForm" name="tipo_item" class="opcion-item">
				<option value="1">Pizza</option>
				<option value="2" selected>Gaseosa</option>
			</select>
			<input type="submit" name="agregar" value="Agregar" class="agregar_item">
			<button  type='button' class="close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
		</form>
		<form method="POST" class="ordenes-form">
			<button type='button' class="ordenar-add_btn" name="agregar_buton">Agregar Item</button>
			<h1 class="ordenar-title">Pizzas</h1>
			<button type='button' class="ordenar-edit_btn"  id="editbtn" onclick="EditTrue()">editar</button>
			<input type="button" value="guardar cambios" name="botonPizzas" onclick="saveEdits()" class="ordenes-save_btn" id="savebtn"/>
			<input type="submit" value="eliminar" class="ordenes-delete_btn" name="eliminar" id="deletebtn"/>
			<div class="ordenar-container">
				
				<table class="ordenar-menu">
					<?php 
					foreach($items as $fila):
						if($fila->getidtipo_item() == "1"){
							$id = "test" . $fila->getid_item();	

					?>
					<tr class="ordenar-menu-row-pizzas">
						<td class="ordenar-menu-col ordenar-menu-col--0">
							<input type="checkbox" class="ordenar-menu-col-pizzas-cb" name="checked[]" id=<?=$id?> value=<?=$fila->getid_item()?> onclick="MostrarDeleteBtn()"/>
						    <label for=<?=$id?> class="ordenar-menu-col-pizzas-cb"></label>
						</td>
						<td class="ordenar-menu-col ordenar-menu-col--1"><?= $fila->getNombre()?>
						</td>
						<td class="ordenar-menu-col ordenar-menu-col--2" ><?= $fila->getDescripcion()?>
						</td>
						<td class="ordenar-menu-col ordenar-menu-col--3"><?= "$" . $fila->getPrecio()?>
						</td>
					</tr>
					<?php
					}
					endforeach;
					?>
				</table>

			</div>
			
			<h1 class="ordenar-title">Gaseosas</h1>
			<button  type='button' class="ordenar-edit_btn" onclick="EditTrueGas()" id="editGasbtn"></i>editar</button>
			<input type="button" value="guardar cambios" name="botonGaseosas" onclick="saveEditsGas()" class="ordenes-save_btn" id="saveGasbtn"/>
			<input type="submit" value="eliminar" name="eliminarGas" class="ordenes-delete_btn" id="deleteGasbtn"/>
			<div class="ordenar-container">
				<table class="ordenar-menu">
					<?php 
					foreach($items as $fila):
						if($fila->getidtipo_item() == "2"){
							$id = "test" . $fila->getid_item();
					?>
					<tr class="ordenar-menu-row-gaseosas">
						<td class="ordenar-menu-col ordenar-menu-col--0">
							<input type="checkbox" id=<?=$id?> name="checkedGas[]" value=<?=$fila->getid_item()?> class="ordenar-menu-col-gaseosas-cb" onclick="MostrarDeleteBtnGas()"/>
						    <label for=<?=$id?>  class="ordenar-menu-col-gaseosas-cb"></label>
						</td>
						<td class="ordenar-menu-col ordenar-menu-col--1" >
							<?= $fila->getNombre()?>
						</td>
						<td class="ordenar-menu-col ordenar-menu-col--2" >
						</td>
						<td class="ordenar-menu-col ordenar-menu-col--3" >
							<?= "$" . $fila->getPrecio()?>
						</td>
					</tr>
					<?php
					}

					endforeach;
					?>
				</table>
			</div>
		</form>
	</section>
	<footer class="footer">
		<img src="../../../Utils/imgs/logo.png" alt="" class="footer-img">
		<p class="footer-paragraph">2017 © puto el que copia</p>
	</footer>
	<script type="text/javascript" src="../../editarmenu.js"></script>
</body>
</html>