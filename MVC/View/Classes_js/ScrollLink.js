class Scroll_Link{
	/**
	constructor. 
	id = id del link
	aid = link del objetivo hacia donde voy a scrollear
	speed = velocidad del scroll. Recomendada "slow".
	**/
	constructor(id,aid,speed){
		this.aTag = $("#" + aid);
		this.div = document.getElementById(id);
		this.speed = speed;
		this.div_clicked();
	}

	//funcion que utiliza el ScrollTop de Ajax (ver el script incluido en el head)
	scrollToAnchor(){
		$('html, body').animate({
			//El scroll se hace hasta el top del div que tiene el aTag como id.
			//le restamos 140 porque el header y el menu_bar tienen 70px de alto cada uno.
			//Si no le restamos 140, queda 140 pixeles tapado
	        scrollTop: this.aTag.offset().top - 140
	    }, this.speed); //la velocidad del scroll
	    return false;
	}
	div_clicked(){
		var obj = this;
		obj.div.onclick = function(){
			obj.scrollToAnchor();
		}
	}
}
