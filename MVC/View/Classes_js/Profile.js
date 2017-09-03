class Profile{
	constructor(form_editProfile, form_seeAdmins, form_createAdmins, links, seeAdminsRows, btn,fields,saveBtn){
		var a =document.getElementsByClassName(form_editProfile)[0];
		var b =document.getElementsByClassName(form_createAdmins)[0];
		var c =document.getElementsByClassName(form_seeAdmins)[0];
		this.fields = document.getElementsByClassName(fields);
		this.saveBtn= document.getElementById(saveBtn);
		this.forms = [a,b,c];
		this.links = document.getElementsByClassName(links);
		this.adminsRows = document.getElementsByClassName(seeAdminsRows);
		this.boton= document.getElementsByClassName(btn)[0];
		this.start();
		this.mostrarBtn();
	}
	start(){
		var obj = this;
		for (var i=0; i < this.links.length-1; i++) {
			(function(index){
				obj.links[i].onclick = function(){
				$(obj.forms[index]).fadeToggle();
				for(var j=0; j<i; j++){
					if(j==index){			
						obj.forms[j].style.display = 'block';
					} else{
						obj.forms[j].style.display = 'none';
					}
				}
			}
			})(i);
		}
		this.links[i].onclick = function(){
			var ask = window.confirm("Realmente quiere cerrar sesion?");
		    if (ask) {
		        window.alert("Sesion Cerrada");
		        window.location.href = '../html/login.html';
		    }
		}
		for (var k=0; k < this.adminsRows.length-1; k++) {
			this.adminsRows[k].onchange = function(){
				if($("input:checkbox:checked").length > 0){
					obj.boton.style.display='block';
			  	}else{
			  		obj.boton.style.display='none';
			  	}
			}		
		}
	}
	mostrarBtn(){
		var obj = this;
		for (var i = 0; i < this.fields.length; i++) {
			$(this.fields[i]).bind('input', function(){
				obj.saveBtn.style.display="block";
			});
		}
	}

}
