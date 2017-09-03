<?php
	require_once "../../Controller/DBManager.php";
	require_once "../../../Utils/php/configuracion.php"; 
	if(isset($_POST['insert_admin'])){
		$admin_name=$_POST['admin_name'];
		$admin_lname=$_POST['admin_lastname'];
		$admin_mail=$_POST['admin_mail'];
		$admin_pass=$_POST['admin_pass'];
		$hash_pass = sha1($admin_pass);
		$query = "INSERT INTO cuentas (nombre, apellido, email, clave, idtipo_cuenta)
						  		VALUES ('$admin_name','$admin_lname','$admin_mail', '$hash_pass',2)";
		$stmt = DBcnx::getStatement($query);
		$stmt->execute();
		header("Refresh:0");
	}
?>