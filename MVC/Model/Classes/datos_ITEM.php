<?php  
    require_once "../../Controller/DBManager.php";
    if(isset($_POST['frows'])){
        $data = $_POST['frows'];    
    }

    if(isset($_POST['frowsG'])){
        $data = $_POST['frowsG'];    
    }
    
    
    try{
        $datalenght = count($data);
        $query = "UPDATE items SET descripcion=:descr, nombre_item=:name, precio=:price WHERE iditem = :id";
        $stmt = DBcnx::getStatement($query);        
        for($i = 0; $i<$datalenght; $i++){
            if($data[$i][0] != ""){
                $stmt->bindparam(':descr', $data[$i][2]);
                $stmt->bindparam(':name', $data[$i][1]);
                $stmt->bindparam(':price', $data[$i][3]);
                $stmt->bindparam(':id', $data[$i][0]);
                $stmt->execute(); 
            }
        }   
    }

    catch(PDOException $e){
       echo $e->getMessage();
    } 
?>
