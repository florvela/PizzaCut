class Controller{
	start(){
		//obtenemos el id del body
		//para evitar errores de "undefined" en caso de que este en otra lengueta
		var body = document.getElementsByTagName("body")[0];
		var id = body.id;

		//Si el body tiene id = mainHtml entonces inicializa los formularios de "tu opinion!" 
		//correspondientes y el pop-up de aumentar cantidad al realizar un pedido

		if(body.id == "mainHtml"){
			var toggleHeader = new ToggleHeader(502,501,".menu_bar-link",".menu_bar-form");
			var opinionForm = new OpinionForm('menu_bar-link','menu_bar-form');
			var pedido = new Pedido_js("ordenar-menu-checkbox","ordenar-cantidad-check","ordenar-cantidad","blur");
			var historial = new Historial('pedidos-historial','ordenes-pedidos_btn');
		} 

		//Si el body tiene id = micuentaHtml entonces inicializa los formularios de "tu opinion!"
		//correspondientes

		else if(body.id == "micuentaHtml"){
			var toggleHeader = new ToggleHeader(502,501,".menu_bar-link",".menu_bar-form");
			var opinionForm = new OpinionForm('menu_bar-link','menu_bar-form');
			var sideForm = new SideForm("side-links","side-form","toggle","block",true,"side-links", "side-form_fields-textarea","savebtn");

			function activate(){
				if (window.matchMedia('screen and (max-width: 400px)').matches) {
					sideForm.availableToMove = false;
					sideForm.changeDisplay("block");
				} else {
					sideForm.availableToMove = true;
					if(sideForm.form.style.display == "block"){
						sideForm.changeDisplay("none");
					}
				}			
			}
			
			activate();
			window.onresize = function(){
				activate();
			}
		}

		//Si el body tiene id = ayudaHtml entonces inicializa los Scroll_link
		//tambien inicializa los formularios de "tu opinion!" correspondientes

		else if(body.id == "ayudaHtml"){
			var toggleHeader = new ToggleHeader(502,501,".menu_bar-link",".menu_bar-form--ayuda");
			var otras = new Scroll_Link("otras","tutorial_otras","slow");
			var hacerpedidos = new Scroll_Link("hacerpedidos","tutorial_hacerpedidos","slow");
			var verpedidos = new Scroll_Link("verpedidos","tutorial_verpedidos","slow");
			var micuenta = new Scroll_Link("micuenta","tutorial_micuenta","slow");
			var opinionForm = new OpinionForm('menu_bar-link','menu_bar-form--ayuda');
		} 

		//Si el body tiene id = contactenosHtml entonces inicializa los formularios de "tu opinion!" 
		//correspondientes

		else if(body.id == "contactenosHtml"){
			var opinionForm = new OpinionForm('menu_bar--bs-link','menu_bar--bs-form');
			var toggleHeader = new ToggleHeader(502,501,".menu_bar--bs-link",".menu_bar--bs-form");
		} 

		else if (body.id == "loginHtml"){
			var IniciarSesion = new Login_Forms('registration_field-form-fields',0,1,"registration_field-login-btn");
			var Registrarse = new Login_Forms('registration_field-form-fields',1,0,"registration_field-signup-btn");
		}
		
		else if (body.id == "mainadminHtml"){
			var _toggleHeader = new ToggleHeader(501,502,".menu_bar-link",".menu_bar-form");
		} 

		else if (body.id == "micuentaadminHtml"){
			var profile = new Profile('side-form','side-form-new_admin','side-form-admins',"side-links", "side-admin_table-row",'side-admin_delete-btn','side-form_fields-textarea','savebtn');
			var toggleHeader = new ToggleHeader(502,501,".menu_bar-link", '.menu_bar-form') ;
		}
	}
}


var controller = new Controller();


//inicializa la funcion start.
if (window.addEventListener) {
    window.addEventListener('load', controller.start());
} else if (window.attachEvent) {
    window.attachEvent('onload', controller.start());
} else { 
    window.onload = controller.start();
}

