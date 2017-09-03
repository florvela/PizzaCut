

class Historial{
	constructor(class_historialPedidos, class_historialBtn){
		var obj = this;
		this.historialPedidos = document.getElementsByClassName(class_historialPedidos)[0];
		this.historialBtn = document.getElementsByClassName(class_historialBtn)[0];
		this.historialBtn.onclick = function(){obj.show();};
	}
	show(){
		$(this.historialPedidos).fadeToggle();
		this.historialPedidos.style.display='block';
	}
}