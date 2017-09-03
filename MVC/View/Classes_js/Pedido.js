class Pedido_js{
	constructor(input,agregar,cantidad,blur){
		var obj = this;
		this.place = null;
		this.total = 0;
		this.inputId = 0;
		this.table = document.getElementsByClassName("ordenar-menu")[0];
		this.table2 = document.getElementsByClassName("ordenar-menu")[1];
		this.agregarBtn = document.getElementsByClassName(agregar)[0];
		this.cantidad = document.getElementsByClassName(cantidad)[0];
		this.input = document.getElementsByClassName(input);
		this.blur = document.getElementsByClassName(blur)[0];
		this.cart = document.getElementsByClassName("cart");
		this.cartTable = document.getElementById("cart-table");
		this.submit = document.getElementsByClassName("ordenes-enviar_btn")[0];
		this.pedido = [];
		console.log(this.pedido.length);
		this.rows = this.cartTable.rows;
		//llamo a las funciones para que agregue los onclick ni bien se cargue el objeto
		this.input_checked();
		this.deletePedido();
		this.itemcheck();
		this.agregarBtn.onclick = function(){
			obj.hide();	
			obj.addToTable();
		}
		this.submit.onclick = function(){
			obj.saveEdits();
		}
	}
	hide(){
		this.cantidad.style.display = 'none';
		this.blur.style.display = 'none';
	}
	show(){
		this.cantidad.getElementsByTagName('input')[0].value = "1"; //para que no se quede guardado el numero anterior y vuelva a contar
		this.cantidad.style.display = 'flex';
		this.blur.style.display = 'block';	
	}

	deletePedido(){
		var obj = this;
		document.getElementById("cart-trash").onclick = function(){
			for(var i = 0; i < obj.input.length; i++){
				obj.input[i].checked = false;
			}
			for(var a = 0; a < obj.pedido.length/*obj.items*/; a++){
				obj.cartTable.deleteRow(0);
			}
			obj.pedido = [];
			obj.updateTotal();
			// obj.items = 0;
			obj.itemcheck();
			obj.total = 0;
		}
	}

	updateTotal(){
		var sum = 0;
		for(var i = 0; i < this.pedido.length; i++){
			sum = sum + parseFloat(this.pedido[i][2]) * parseFloat(this.pedido[i][0]) ;
		}
		this.total = sum;
		console.log(sum);
		document.getElementsByClassName("cart-total--number")[0].innerHTML = "$" + this.total;
	}

	itemcheck(){
		if (this.pedido.length == 1) {
			document.getElementById("pedidoVacio").style.display = "none";
			document.getElementsByClassName("pedido-vacio--p")[0].style.display = "none";
			document.getElementById("cart-trash").style.display = "inline-block";
			document.getElementsByClassName("cart-info")[0].style.display = "block";
			document.getElementsByClassName("cart-table")[0].style.display = "block";
			document.getElementsByClassName("ordenes-enviar_btn")[0].disabled = false;
		} else if (this.pedido.length == 0) {
			document.getElementById("cart-trash").style.display = "none";
			document.getElementsByClassName("cart-info")[0].style.display = "none";
			document.getElementsByClassName("cart-table")[0].style.display = "none";
			document.getElementById("pedidoVacio").style.display = "block";
			document.getElementsByClassName("pedido-vacio--p")[0].style.display = "block";
			document.getElementsByClassName("ordenes-enviar_btn")[0].disabled = true;
		}
	}
	addToTable(){
		var obj = this;
		var row = this.cartTable.insertRow();
		var cant = this.cantidad.getElementsByTagName('input')[0].value;
		var label, precio;
		row.className = "cart-table--row";
		// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		cell1.className = "cart-table--column-1";
		cell2.className = "cart-table--column-2";
		cell3.className = "cart-table--column-3";
		// Add some text to the new cells:
		var cell1_innerHtml = '<input type="number" class="cart-number" name="1" value="' + cant + '" min="1" max="50">';
		cell1.innerHTML = cell1_innerHtml;
		//para ver en que tabla se hizo click, utilizo la variable this.place
		if(this.place < this.table.rows.length){
			label = this.table.rows[this.place].cells[1].innerHTML;
			precio = this.table.rows[this.place].cells[3].innerHTML;
		} else {
			label = this.table2.rows[this.place - this.table.rows.length].cells[1].innerHTML;
			precio = this.table2.rows[this.place - this.table.rows.length].cells[3].innerHTML;
		}	
		cell2.innerHTML = label;
		cell3.innerHTML = precio;
		this.addItem(this.inputId ,cant, label.trim(), precio.trim().slice(1));
		(function(index){
			obj.cartTable.rows[index].cells[0].getElementsByTagName("input")[0].onchange = function(){
				var newVal = this.value;
				obj.updateItem(index,newVal);
			}
		})(this.pedido.length - 1);	
		this.itemcheck();
	}
	addItem(param_id, param_cant, param_label, param_precio){
		var obj = this;
		var item =[], cantidad, label, precio;
		cantidad = param_cant;
		label = param_label;
		precio = param_precio;
		
		item.push(cantidad);
		item.push(label);
		item.push(precio);
		item.push(param_id);
		this.pedido.push(item);
		console.log(this.pedido);	
		obj.updateTotal();		
	}
	changeOnClicks(){
		var obj = this;
		for(var i=0; i<this.pedido.length; i++){
			(function(index){
				console.log(obj.cartTable.rows.length);
				if(obj.cartTable.rows.length != 0){
					obj.cartTable.rows[index].cells[0].getElementsByTagName("input")[0].onchange = function(){
						var newVal = this.value;
						obj.updateItem(index,newVal);
					}
				} else {
					obj.pedido = [];
					obj.updateTotal();
					obj.itemcheck();
					obj.total = 0;
				}
					
			})(i);	
		}
	}
	removeItem(index){
		this.pedido.splice(index, 1);
		console.log(this.pedido);
		this.updateTotal(); 
	}
	updateItem(index,newCant){
		this.pedido[index][0] = newCant;
		console.log(this.pedido);
		this.updateTotal();
	}
	deleteFromTable(){
		for(var a = 0; a < this.cartTable.getElementsByTagName("tr").length; a++){
			if(this.place < this.table.rows.length){
				if(this.cartTable.rows[a].cells[1].innerHTML == this.table.rows[this.place].cells[1].innerHTML){
					var newCant = parseFloat(this.cartTable.rows[a].cells[0].getElementsByTagName('input')[0].value);
					this.cartTable.deleteRow(a);
				}
			} else {
				if(this.cartTable.rows[a].cells[1].innerHTML == this.table2.rows[this.place - this.table.rows.length].cells[1].innerHTML){
					var newCant = parseFloat(this.cartTable.rows[a].cells[0].getElementsByTagName('input')[0].value);
					this.cartTable.deleteRow(a);
				}
			}
		}
		this.itemcheck();
	}

	input_checked(){
		var obj = this;
		for (var i = 0; i < obj.input.length; i++){
			(function(index){
				obj.input[i].onclick = function(){
					for (var j = 0; j< obj.input.length; j++){
						if(obj.input[j].id == this.id){
							obj.place = j;
							obj.inputId = parseInt(this.id.slice(4));
						}
					}
					if(this.checked){ 	
						obj.show();
					} else { 
						obj.deleteFromTable();
						obj.removeItem(index);
						obj.changeOnClicks();
						obj.updateTotal();
					}
				}
			})(i);
		}
	}
	saveEdits() {
		var pedido_para_enviar = this.pedido;
		var total_para_enviar = this.total;
		$.ajax({
			url: "main.php",
			data: {'pedido':pedido_para_enviar,"total":total_para_enviar},
			type: "POST",
			success : function(data,status) {
						if(status == 'success'){
							alert("Tu pedido ha sido enviado!!!");
							window.location.reload(true);
						}	
					},
			error : function() {
				alert('Hubo un problema con la realización de su pedido. Lo sentimos mucho. Por favor, inténtelo de nuevo.');
			}
		});
	}
}

	


