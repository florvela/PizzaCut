<?php
class Item{
	private $id_item;
	private $descripcion;
	private $nombre_item;
	private $idtipo_item;
	private $precio;
	public static $tabla = "Items";
	private static $fila = ['iditem', 'descripcion', 'nombre_item', 'idtipo_item', 'precio'];
	public function setid_item($a){
		$this->id_item = $a;
	}
	public function getid_item(){
		return $this->id_item;
	}
	public function setdescripcion($a){
		$this->descripcion = $a;
	}
	public function getdescripcion(){
		return $this->descripcion;
	}
	public function setnombre($a){
		$this->nombre_item = $a;
	}
	public function getnombre(){
		return $this->nombre_item;
	}
	public function setidtipo_item($a){
		$this->idtipo_item = $a;
	}
	public function getidtipo_item(){
		return $this->idtipo_item;
	}
	public function setprecio($a){
		$this->precio = $a;
	}
	public function getprecio(){
		return $this->precio;
	}

	public function getByPk($id){
		$this->id_item = $id;
		$query = "SELECT * FROM " . static::$tabla . "
					WHERE iditem = " . $id;
		$stmt = DBcnx::getStatement($query);
		$stmt->execute();
		$this->cargarDatos($stmt->fetch(PDO::FETCH_ASSOC));
		return $this;
	}
	public function cargarDatos($fila){
		foreach($fila as $prop => $valor) {
			if(in_array($prop, static::$fila)) {
				switch($prop){
					case "descripcion":
						$this->setdescripcion($valor);
					break;
					case "nombre_item":
						$this->setnombre($valor);
					break;
					case "idtipo_item":
						$this->setidtipo_item($valor);
					break;
					case "precio":
						$this->setprecio($valor);
					break;
				}
			}
		}
	}
	public function crear_item(){
		$query = "INSERT INTO " . static::$tabla . " (descripcion, nombre_item, idtipo_item, precio)
				VALUES (:descripcion, :nombre, :idtipo_item, :precio)";
		$stmt = DBcnx::getStatement($query);

		return $stmt->execute([
			':descripcion' => $this->setdescripcion(descripcion),
			':nombre_item' => $this->setnombre(nombre),
			':idtipo_item' => $this->setidtipo_item(idtipo_item),
			':precio' => $this->setprecio(precio),		
		]);
	}
	public function update_item($param_id,$param_descr,$param_nombre,$param_tipo,$param_precio){
		$query = "UPDATE " . static::$tabla . " SET descripcion ='$param_descr', 
													nombre_item='$param_nombre',
													idtipo_item='$param_tipo', 
													precio='$param_precio'
												WHERE id_item='$param_id'";
		$stmt = DBcnx::getStatement($query);
		if($stmt->execute()){
			if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
				$this->id_item = $fila['iditem'];
				$this->cargarDatos($fila);
				$salida[] = $item;
			}
		}
	}
	public static function all(){
		$salida = [];
		$query = "SELECT * FROM " . static::$tabla;
		$stmt = DBcnx::getStatement($query);
		if($stmt->execute()) {
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$item = new Item;
				$item->id_item = $fila['iditem'];
				$item->cargarDatos($fila);
				$salida[] = $item;
			}
		}
		return $salida;
	}
}