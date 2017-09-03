<?php
	require_once "../../Controller/DBManager.php";
	
	$datalength=0;
	if(isset($_POST['eliminar'])){
		$data = $_POST['checked'];
		$datalength = count($_POST['checked']);
	}
	if(isset($_POST['eliminarGas'])){
		$data = $_POST['checkedGas'];
		$datalength = count($_POST['checkedGas']);
	}
	try{
		$query = "DELETE FROM pedidos_has_items WHERE iditem_phi  = :id;";
		$query2 = "DELETE FROM items WHERE iditem = :id;";
		$stmt = DBcnx::getStatement($query);
		$stmt2 = DBcnx::getStatement($query2);
		for($i = 0; $i<$datalength; $i++){
			$stmt->bindparam(':id', $data[$i]);
			$stmt->execute();
			$stmt2->bindparam(':id', $data[$i]);
			$stmt2->execute();

		}
	}
	catch(PDOException $e){
       echo $e->getMessage();
    }

?>