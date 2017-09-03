<?php
	require_once "../../Controller/DBManager.php";
	require_once "../../../Utils/php/configuracion.php";

	$session = $_SESSION['user'];
	$query = "SELECT nombre, apellido, direccion, email, clave, telefono FROM cuentas WHERE idcuenta = '$session'";
	$stmt = DBcnx::getStatement($query);
	if($stmt->execute()) {
			$fila = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	if(isset($_POST['updated'])){
        if(!empty($_POST['new_name'])){
        	$name = $_POST['new_name'];
        }
        else{
        	$name = $fila['nombre'];
        }    
        if(!empty($_POST['new_lname'])){
        	$lname = $_POST['new_lname'];
        }
        else{
        	$lname = $fila['apellido'];
        }
        if(!empty($_POST['new_direc'])){
        	$direc = $_POST['new_direc'];
        }
        else{
        	$direc = $fila['direccion'];
        }
        if(!empty($_POST['new_mail'])){
        	$mail = $_POST['new_mail'];
        }
        else{
        	$mail = $fila['email'];
        }    
        if(!empty($_POST['new_pass'])){
        	$npass = sha1($_POST['new_pass']);

        }
        else{
        	$npass = $fila['clave'];
        }

        if(!empty($_POST['new_tel'])){
        	$tel = $_POST['new_tel'];
        }
        else{
        	$tel = $fila['telefono'];
        }
        try{
	        $query = "UPDATE cuentas SET nombre='$name', apellido='$lname', direccion='$direc', email='$mail', clave='$npass', telefono='$tel' WHERE idcuenta = '$session'";
	        $stmt = DBcnx::getStatement($query);
	        $stmt->execute();
	    }

	    catch(PDOException $e){
	       echo $e->getMessage();
	    }
	}
	if(isset($_POST['delete_cuenta'])){
		$query = "DELETE FROM pedidos_has_items WHERE idpedido_phi in (select idpedido from pedidos where idcuenta_p = '$session');
		delete from pedidos where idcuenta_p = '$session';
		delete from cuentas where idcuenta = '$session';";
		$stmt = DBcnx::getStatement($query);
	    $stmt->execute();
	    var_dump($stmt->execute());
	    unset($_SESSION['user']);
	    header("Location: ../../../index.php");
	}

?>