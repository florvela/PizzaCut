<?php
	require_once "../../Controller/DBManager.php";
	
	$errEmpty = $errPrice ="";

	
		if(isset($_POST['agregar'])){
			if(empty($_POST['itemname'])){
				$errEmpty= "Completar";
			}
			if(empty($_POST['price'])){
				$errPrice= "Completar";
			}

			if(isset($_POST['itemname']) && isset($_POST['price'])){
				$price = $_POST['price'];
				$price = str_replace('$', '', $price);
				$name = $_POST['itemname'];
				$desc = $_POST['descripcion'];
				$tipoIt = $_POST['tipo_item'];
				
				$query = "INSERT INTO items (descripcion, nombre_item, idtipo_item, precio)
						  		VALUES ('$desc','$name','$tipoIt', '$price')";
				$stmt = DBcnx::getStatement($query);
				$stmt->execute();
				header("Refresh:0");
			}
		}
	
?>