<?php 
	require_once "../Controller/DBManager.php";
	require_once "../../Utils/php/configuracion.php";
	require_once "Classes/Pedido.php";

	$pedido = new Pedido();
	$pedido->update_state($_POST["idpedidoAJAX"],$_POST["idestado"]);

?>