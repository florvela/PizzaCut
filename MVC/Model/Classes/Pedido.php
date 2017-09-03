<?php
require_once "Item.php";

class Pedido{
	private $idpedido;
	private $direccion;
	private $precio_pagar;
	private $idestado_p;
	private $idcuenta_p;
	private $datetime_p;
	private $descripcion_estados;
	private $items_arr;
	public static $tabla = "Pedidos";
	private static $fila = ['idpedido', 'direccion', 'precio_pagar','idestado_p','idcuenta_p','datetime_p','descripcion_estados'];
	
	public function setidpedido($a){
		$this->idpedido = $a;
	}
	public function getidpedido(){
		return $this->idpedido;
	}
	public function setitems_arr($a){
		$this->items_arr = $a;
	}
	public function getitems_arr(){
		return $this->items_arr;
	}
	public function setdescripcion_estados($a){
		$this->descripcion_estados = $a;
	}
	public function getdescripcion_estados(){
		return $this->descripcion_estados;
	}
	public function setdireccion($a){
		$this->direccion = $a;
	}
	public function getdireccion(){
		return $this->direccion;
	}
	public function setprecio_pagar($a){
		$this->precio_pagar = $a;
	}
	public function getprecio_pagar(){
		return $this->precio_pagar;
	}
	public function setidestado_p($a){
		$this->idestado_p = $a;
	}
	public function getidestado_p(){
		return $this->idestado_p;
	}
	public function setidcuenta_p($a){
		$this->idcuenta_p = $a;
	}
	public function getidcuenta_p(){
		return $this->idcuenta_p;
	}
	public function setdatetime_p($a){
		$this->datetime_p = $a;
	}
	public function getdatetime_p(){
		return $this->datetime_p;
	}

	public function getByPk($id){
		$this->idpedido = $id;
		$query = "SELECT * FROM " . static::$tabla . "
					WHERE ID = ?";
		$stmt = DBcnx::getStatement($query);
		$stmt->execute([$id]);
		$this->cargarDatos($stmt->fetch(PDO::FETCH_ASSOC));
	}
	public function cargarDatos($fila){
		foreach($fila as $prop => $valor) {
			if(in_array($prop, static::$fila)) {
				switch($prop){
					case "precio_pagar":
						$this->setprecio_pagar($valor);
					break;
					case "descripcion_estados":
						$this->setdescripcion_estados($valor);
					break;
					case "direccion":
						$this->setdireccion($valor);
					break;
					case "idestado_p":
						$this->setidestado_p($valor);
					break;
					case "idcuenta_p":
						$this->setidcuenta_p($valor);
					break;
					case "datetime_p":
						$this->setdatetime_p($valor);
					break;
				}
			}
		}
	}
	public function crear_item(){
		$query = "INSERT INTO " . static::$tabla . " (precio_pagar, idestado_p, idcuenta_p, datetime_p)
				VALUES (:precio_pagar, :idestado_p, :idcuenta_p, :datetime_p)";
		$stmt = DBcnx::getStatement($query);

		return $stmt->execute([
			':precio_pagar' => $this->setprecio_pagar(descripcion),
			':idestado_p' => $this->setidestado_p(nombre),
			':idtipo_item' => $this->setidcuenta_p(idtipo_item),
			':datetime_p' => $this->setdatetime_p(precio),		
		]);
	}
	public function update_item($param_id,$param_precio,$param_idestado,$param_idcuenta,$param_dt){
		$query = "UPDATE " . static::$tabla . " SET precio_pagar ='$param_precio', 
													idestado_p='$param_idestado',
													idcuenta_p='$param_idcuenta', 
													pdatetime_p='$param_dt'
												WHERE idpedido='$param_id'";
		$stmt = DBcnx::getStatement($query);
		if($stmt->execute()){
			if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
				$this->idpedido = $fila['idpedido'];
				$this->cargarDatos($fila);
				$salida[] = $item;
			}
		}
	}
	public function update_state($param_id,$param_descrip_estado_p){
		$query = "UPDATE " . static::$tabla . " SET idestado_p = " . $param_descrip_estado_p ." WHERE idpedido = ". $param_id .";";
		$stmt = DBcnx::getStatement($query);
		if($stmt->execute()){
			if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
				$this->idpedido = $fila['idpedido'];
				$this->cargarDatos($fila);
				$salida[] = $item;
			}
		} 
	}


	public static function all(){
		$salida = [];
		$query = "SELECT idpedido,  direccion, precio_pagar, 
					idestado_p, idcuenta_p, datetime_p, descripcion_estados
					FROM ". static::$tabla .", cuentas, estados
					WHERE idcuenta = idcuenta_p AND idestado = idestado_p;";
		$stmt = DBcnx::getStatement($query);
		if($stmt->execute()) {
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$pedido = new Pedido;
				$pedido->idpedido = $fila['idpedido'];
				$pedido->cargarDatos($fila);
				$query2 = "SELECT iditem_phi FROM pedidos_has_items
							WHERE idpedido_phi =" . $pedido->getidpedido();
				$stmt2 = DBcnx::getStatement($query2);
				if($stmt2->execute()){
					while($fila2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
						$item = new Item;
						$array123 = $item->getByPk($fila2['iditem_phi']);
						$pedido->items_arr[]= $item->getnombre();
					}
				}
				$salida[] = $pedido;
			}
		}
		return $salida;

	}
}