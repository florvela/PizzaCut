<?php
	require_once "../../Controller/DBManager.php";
	require_once "../../../Utils/php/configuracion.php"; 

	if(isset($_POST['Eliminar_usr-btn'])){
		if(isset($_POST['checkDel'])){
			$data = $_POST['checkDel'];
			$datalength = count($_POST['checkDel']);
		}
		try{
			$query = "DELETE FROM cuentas WHERE idcuenta = :id";
			$stmt = DBcnx::getStatement($query);
			for($i = 0; $i<$datalength; $i++){
				$stmt->bindparam(':id', $data[$i]);
				if($data[$i] != $_SESSION['user']){
					$stmt->execute();
				}
			}
		}
		catch(PDOException $e){
	       echo $e->getMessage();
	    }
	}
?>