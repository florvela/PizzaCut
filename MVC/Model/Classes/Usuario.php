<?php
class USER{
	private $codigo_usuario;
	private $nombre;
	private $apellido;
	private $direccion;
	private $email;
	private $clave;
	private $telefono;
	private $idtipo_cuenta;
	public static $tabla = "cuentas";
	private static $fila = ['nombre','apellido','direccion','email','clave','telefono','idtipo_cuenta'];

	public function setIdCuenta($a){
		$this->codigo_usuario = $a;
	}
	public function getIdCuenta(){
		return $this->codigo_usuario;
	}	
	public function setIdTipoCuenta($a){
		$this->idtipo_cuenta = $a;
	}
	public function getIdTipoCuenta(){
		return $this->idtipo_cuenta;
	}
	public function setApellido($a){
		$this->apellido = $a;
	}
	public function getApellido(){
		return $this->apellido;
	}
	public function setDireccion($a){
		$this->direccion = $a;
	}
	public function getDireccion(){
		return $this->direccion;
	}
	public function setTelefono($a){
		$this->telefono = $a;
	}
	public function getTelefono(){
		return $this->telefono;
	}
	public function setMail($a){
		$this->email = $a;
	}
	public function getMail(){
		return $this->email;
	}
	public function setNombre($a){
		$this->nombre = $a;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function setClave($a){
		$this->clave = $a;
	}
	public function getClave(){
		return $this->clave;
	}
	public function getByPk($id){
		$this->codigo_usuario = $id;
		$query = "SELECT * FROM " . static::$tabla . "
					WHERE ID = ?";
		$stmt = DBcnx::getStatement($query);
		$stmt->execute([$id]);
		$this->cargarDatos($stmt->fetch(PDO::FETCH_ASSOC));
		var_dump($stmt->fetch(PDO::FETCH_ASSOC));
		return $this;
	}
	
	public function cargarDatos($fila){
		foreach($fila as $prop => $valor) {
			if(in_array($prop, static::$fila)) {
				switch($prop){
					
					case "email":
						$this->setMail($valor);
					break;
					case "clave":
						$this->setClave($valor);
					break;
					case "nombre":
						$this->setNombre($valor);
					break;
					case "apellido":
						$this->setApellido($valor);
					break;
					case "direccion":
						$this->setDireccion($valor);
					break;
					case "telefono":
						$this->setTelefono($valor);
					break;
					case "idtipo_cuenta":
						$this->setIdTipoCuenta($valor);
					break;
				}
			}
		}
	}

	/********************* LISTAR TODA LA TABLA CUENTAS *************************/
	public static function all(){
		$salida = [];
		$query = "SELECT * FROM " . static::$tabla . ";";
		$stmt = DBcnx::getStatement($query);
		if($stmt->execute()) {
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$usuario = new USER;
				$usuario->codigo_usuario = $fila['idcuenta'];
				$usuario->cargarDatos($fila);
				$salida[] = $usuario;
			}
		}
		return $salida;
	}
	
	/********************* REGISTRO *************************/
	public function register ($array){
		//CREO USUARIO
		$array["idtipo_cuenta"]=0;
		$upass = sha1($array['upass']);
		$query = "INSERT INTO " . static::$tabla . " (nombre, apellido, direccion, email, clave, telefono, idtipo_cuenta) VALUES ('$array[fname]', '$array[lname]', '$array[udir]','$array[umail]','$upass','$array[utel]','$array[idtipo_cuenta]') ";
		$stmt = DBcnx::getStatement($query);
			if($stmt->execute()) {
				echo "guardado";
			}   
			else{
				"error en conexion bdd";
			}
		
    }
	
	/****************************** LOGIN ********************/
 
    public function login($umail,$upass){
		$upass = sha1($upass);
		$query = "SELECT * FROM " .static::$tabla. " WHERE email='$umail' AND clave='$upass' ";
		$stmt = DBcnx::getStatement($query);
		if($stmt->execute()) {
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$usuario = new USER;
				$usuario->codigo_usuario = $fila['idcuenta'];
				$usuario->cargarDatos($fila);
				$salida[] = $usuario;
			}
		}
		return $salida;
    }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }

   public function notlogged(){
      if($this->is_loggedin()==false){
        $this->redirect('index.php');
      }
   }
}
?>