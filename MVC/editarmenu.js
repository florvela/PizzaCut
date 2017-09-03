var changed_ids = [];
var changed_idsG = [];
//var changedRows = [];
var rows = [];
var rowsG = [];

var savbtn=document.getElementsByClassName("ordenar-add_btn")[0];
var form=document.getElementsByClassName('insert_form')[0];
var close=document.getElementsByClassName('close_btn')[0];
var blur=document.getElementsByClassName('blur')[0];
$(document).ready(function(){
    $(savbtn).click(function(){
    	$('body').css('overflow','hidden');
        $(form).css('display','block');
        $(blur).css('display','block');
    });
    $(close).click(function(){
    	$('body').css('overflow','auto');
        $(form).css('display','none');
        $(blur).css('display','none');
        window.location.reload(true);
    });
});


function EditTrue(){
	var editElem = document.getElementsByClassName('ordenar-menu-row-pizzas');
	for (var i=0; i<editElem.length; i++){
		editElem[i].contentEditable=true;
		editElem[i].style.color="gray";
		editElem[i].style.fontStyle="italic";
	}
	var btn=document.getElementById('savebtn');
		$(btn).fadeToggle();
		btn.style.display = 'inline-block';
	var editBtn = document.getElementById('editbtn');
	var c = document.getElementsByClassName('ordenar-menu-col-pizzas-cb');
	if(editBtn.innerHTML=="editar"){
		editBtn.innerHTML="cancelar";
    	for (var i = 0; i < c.length; i++) {
            c[i].style.visibility="visible";
        }
    }else{
		editBtn.innerHTML="editar";
		for (var j=0; j<editElem.length; j++){
			editElem[j].contentEditable=false;
			window.location.reload(true);
			for (var i = 0; i < c.length; i++) {
	        	c[i].style.visibility="hidden";
	        	
			}
		}
	}
}
function EditTrueGas(){
	var editElem = document.getElementsByClassName('ordenar-menu-row-gaseosas');
	var noteditElem = document.getElementsByClassName('ordenar-menu-col ordenar-menu-col--2');
	for (var i=0; i<editElem.length; i++){
		editElem[i].contentEditable=true;
		noteditElem[i].contentEditable=false;
		editElem[i]
		editElem[i].style.color="gray";
		editElem[i].style.fontStyle="italic";
	}
	var btn=document.getElementById('saveGasbtn');
		$(btn).fadeToggle();
		btn.style.display = 'inline-block';
	var editBtn = document.getElementById('editGasbtn');
	var c = document.getElementsByClassName('ordenar-menu-col-gaseosas-cb');
	if(editBtn.innerHTML=="editar"){
		editBtn.innerHTML="cancelar";
    	for (var i = 0; i < c.length; i++) {
            c[i].style.visibility="visible";
        }
    }else{
		editBtn.innerHTML="editar";
		for (var j=0; j<editElem.length; j++){
			editElem[j].contentEditable=false;
			window.location.reload(true);
			for (var i = 0; i < c.length; i++) {
	        	c[i].style.visibility="hidden";
	        	
			}
		}
	}
}

function MostrarDeleteBtn() {
	var boton = document.getElementById('deletebtn');
	var pizzas = $("input.ordenar-menu-col-pizzas-cb:checkbox:checked");
	var pizza_class = "ordenar-menu-col-pizzas-cb";
	if(pizzas.length > 0){
		boton.style.display='inline-block';
  	}else{
  		boton.style.display='none';
  	}
}
function MostrarDeleteBtnGas() {
	var boton= document.getElementById('deleteGasbtn');
	if($("input.ordenar-menu-col-gaseosas-cb:checkbox:checked").length > 0){
		boton.style.display='inline-block';
  	}else{
  		boton.style.display='none';
  	}
}
var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};

/*function updateRows(param_rows){
	for(var i =0; i<changed_ids.length; i++){
		var changedRow = param_rows[changed_ids[i]-1] 
		if(!(contains.call(changedRows, changedRow))){
			changedRows.push(changedRow);
		}
	}
}*/

function saveLocalStorage(){
	var editElem = document.getElementsByClassName('ordenar-menu-row-pizzas');
	for (var i=0; i<editElem.length; i++){
		$(editElem[i]).bind('input', function(){
			var id = parseInt(this.cells[0].getElementsByTagName('input')[0].id.slice(4));
			if(!(contains.call(changed_ids,id))){
				changed_ids.push(id);
			}
			var row = [];
			var editElem1 = this.cells[1].innerHTML.trim();
			var editElem2 = this.cells[2].innerHTML.trim();
			var editElem3 = this.cells[3].innerHTML.trim().slice(1);
			row.push(changed_ids[changed_ids.length-1]);
			row.push(editElem1);
			row.push(editElem2);
			row.push(editElem3);
			rows[id-1] = row;
			console.log(rows);
			
		});
	}	
}

function saveLocalStorageGas(){
	var editElem = document.getElementsByClassName('ordenar-menu-row-gaseosas');
	for (var i=0; i<editElem.length; i++){
		$(editElem[i]).bind('input', function(){
			var id = parseInt(this.cells[0].getElementsByTagName('input')[0].id.slice(4));
			if(!(contains.call(changed_idsG,id))){
				changed_idsG.push(id);
			}
			var row = [];
			var editElem1 = this.cells[1].innerHTML.trim();
			var editElem2 = this.cells[2].innerHTML.trim();
			var editElem3 = this.cells[3].innerHTML.trim().slice(1);
			row.push(changed_idsG[changed_idsG.length-1]);
			row.push(editElem1);
			row.push(editElem2);
			row.push(editElem3);
			rowsG[id-1] = row;
			console.log(rowsG);
			
		});
	}	
}


function saveEdits() {

	$.ajax({
		url: "Model/Classes/datos_ITEM.php",
		data: {'frows':rows},
		type: "POST",
		success : function(data,status) {
					
					if(status == 'success'){
						alert("Datos Cambiados");
						var editElem = document.getElementsByClassName('ordenar-menu-row-pizzas');
						for (var i=0; i<editElem.length; i++){
							editElem[i].contentEditable=false;
							window.location.reload(true);
						}
					}
					
				},
		error : function() {
			alert('There was a problem');
		}

	});

}


function saveEditsGas() {

	$.ajax({
		url: "../../Model/Classes/datos_ITEM.php",
		data: {'frowsG':rowsG},
		type: "POST",
		success : function(data,status) {
					
					if(status == 'success'){
						alert("Datos Cambiados");
						var editElem = document.getElementsByClassName('ordenar-menu-row-gaseosas');
						for (var i=0; i<editElem.length; i++){
							editElem[i].contentEditable=false;
							window.location.reload(true);
						}
					}
					
				},
		error : function() {
			alert('There was a problem');
		}

	});
}


saveLocalStorage();
saveLocalStorageGas();




