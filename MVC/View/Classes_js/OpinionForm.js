
class OpinionForm{
	constructor(link,form){
		var obj = this;
		this.opinion = document.getElementsByClassName(link)[0];
		this.form = document.getElementsByClassName(form)[0];
		this.opinion.onclick = function(){
			obj.show(); 
		}
	}

	show(){
		$(this.form).fadeToggle();
		this.form.style.display = 'block';
	}
}