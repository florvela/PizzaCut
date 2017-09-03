<?php
	require_once "../../Controller/DBManager.php";
	require_once "../../../Utils/php/configuracion.php";

	$session = $_SESSION['user'];
	$query = "SELECT nombre, apellido, email, clave FROM cuentas WHERE idcuenta = '$session'";
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
    

	    try{
	        $query = "UPDATE cuentas SET nombre='$name', apellido='$lname', email='$mail', clave='$npass' WHERE idcuenta = '$session'";
	        $stmt = DBcnx::getStatement($query);
	        $stmt->execute();
	    }

	    catch(PDOException $e){
	       echo $e->getMessage();
	    }
	}

?>