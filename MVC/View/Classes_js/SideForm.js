class SideForm{
	
	constructor(link, name, movement, display, bool, btn,fields,savebtn){
		this.edit_div = document.getElementsByClassName(link)[0];
		this.form = document.getElementsByClassName(name)[0];
		this.logOutBtn= document.getElementsByClassName(btn)[1];
		this.saveBtn= document.getElementById(savebtn);
		this.fields= document.getElementsByClassName(fields);
		this.movement = movement;
		this.display = display;
		this.availableToMove = bool;

		//llamo la funcion que inicializa el onclick ni bien carga
		this.edit_div_clicked();
		this.cerrarSesion();
		this.mostrarBtn();
	}

	mostrarForm(){
		$(this.form).animate(
			{width:this.movement},
			350
		);	
		this.form.style.display = this.display;
	}

	mostrarBtn(){
		var obj = this;
		for (var i =0; i< this.fields.length; i++) {
			$(this.fields[i]).bind('input', function(){
			obj.saveBtn.style.display="block";
		});
		};
	}

	edit_div_clicked(){
		var obj = this;
		obj.edit_div.onclick = function(){
			if(obj.availableToMove){
				obj.mostrarForm();	
			}
		}
	}

	changeDisplay(newDisplay){
		this.form.style.display = newDisplay;
	}

	cerrarSesion(){
		var obj = this;
		obj.logOutBtn.onclick = function(){
			var ask = window.confirm("Realmente quiere cerrar sesion?");
	    	if (ask) {
		        location.href = '../html/logout.php';
		    }
		}
	}

}


