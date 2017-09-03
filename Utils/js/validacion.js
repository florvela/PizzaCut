	function nombre_apellido(val){
		var exp=/^[a-z·ÈÌÛ˙Ò\s]+$/i;
		return exp.test( val);
	}
	function dni_f(val){
		var exp=/^\d{2}\.\d{3}\.\d{3}$/;
		return exp.test( val);
	}
	function fecha_f(val){
		var exp=/^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])(\/|\-)(0?[1-9]|1[0-2])(\/|\-)(19[2-9][0-9]|20[0-1][0-5])$/;
		return exp.test(val);
	}
	function foto_f(val){
		var exp=/^.+(.jpe?g|.png)$/i;
		return exp.test(val); 
	}
	function email_f(val){
		var exp=/^([a-zA-Z\d\-\.]{3,25}@[a-z]{3,15}\.[a-z]{2,4})?$/;
		return exp.test( val);
	}
	function usuario_f(val){
		var exp=/^([A-Z¡…Õ”⁄—]{4,25})?$/;
		return exp.test( val);		
	}
	function clave_f(val){
		var exp=/^([a-zA-Z\d_#,;~@%&\\\!\$\^\*\(\)\-\+\=\{\}\[\]\:\'\\<\>\.\?\|]{3,15})?$/;
		return exp.test( val);
	}
	function calle_f(val){
		var exp=/^([a-z\d\-]+)?$/i;
		return exp.test(val); 
	}
	function numero_f(val){
		var exp=/^(\d*|S\/N)?$/;
		return exp.test(val); 
	}
	function piso_f(val){
		var exp=/^(\d*|S\/N|PB)?$/;
		return exp.test(val); 
	}
	function depto_f(val){
		var exp=/^(\d+|[a-z])?$/i;
		return exp.test(val); 
	}