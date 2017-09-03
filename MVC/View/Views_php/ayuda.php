<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- funcion ScrollTo de ajax -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/Fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/ayuda.css">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/header.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pizza Cut</title>
</head>
<body id="ayudaHtml">
	<header class="menu_bar--ayuda">
		<i id="mobile_bars" class="fa fa-bars fa-2x" aria-hidden="true"></i>
		<div class="menu_bar-link">Tu opinion!</div>
		<form method="POST" class="menu_bar-form--ayuda">
			<textarea maxlength="250" class="menu_bar-link-textarea" placeholder="Compartinos tu opinion..."></textarea>
			<button type="submit" class="menu_bar-link-btn">Enviar</button>
		</form>
		<a href="contactenos.php" class="menu_bar-link">Contactenos</a>
		<a href="#" class="selected menu_bar-link">Ayuda</a>
		<a href="micuenta.php" class="menu_bar-link">Mi Cuenta</a>	
		<a href="main.php" class="menu_bar-link">Pedidos</a>
	</header>
	<section>
		<div class="subheader">
			<div class="subheader-link" id="otras"> Otras Preguntas Frecuentes </div>
			<div class="subheader-link" id="hacerpedidos"> ¿Como realizo pedidos? </div>
			<div class="subheader-link" id="verpedidos"> ¿Como veo mis pedidos? </div>
			<div class="subheader-link" id="micuenta"> ¿Para qué sirve "Mi Cuenta"? </div>
		</div>
	</section>
	<section class="tutorial">
		<table class="information">
			<tr class="information_row" id="tutorial_micuenta">
				<td class="information_col">
					<h2 class="information_col-text-h2">
						Mi Cuenta
					</h2>
					<p class="information_col-text-p">
						En "Mi Cuenta" puedes ver todos tus datos y modificarlos. Aquí van tu mail y la dirección donde te enviaremos nuestras deliciosas pizzas!
					</p>
					<img src="../../../Utils/imgs/micuenta.png" class="information-img">
				</td>
			</tr>
			<tr class="information_row" id="tutorial_verpedidos">
				<td class="information_col">
					<h2 class="information_col-text-h2">
						Ver Mis Pedidos
					</h2>
					<p class="information_col-text-p">
						Para ver tus pedidos, asegurate de estar en la lengueta correspondiente. Si no te encuentras en ella, busca arriba y a la derecha de la página, donde encontrarás "Pedidos". Hacé click ahí!
					</p>
					<img src="../../../Utils/imgs/pedidos.png" class="information-img">
					<p class="information_col-text-p">
						Aquí se despliegan dos tablas. Abajo de esto, hay dos botones, uno que dice "Evniar" y un botón que dice "Mis Pedidos". Hacé click en el que dice "Mis Pedidos". 
					</p>
					<img src="../../../Utils/imgs/mispedidos.png" class="information-img">
					<p class="information_col-text-p">
						A continuación se muestran tus pedidos actuales y el historial de pedidos. 
					</p>
					<img src="../../../Utils/imgs/mispedidos_screenshot.png" class="information-img">
					<p class="information_col-text-p">
						Podés cancelar los pedidos actuales mientras que no se encuentren en esado "En Camino", simplemente haciendo click en la casilla de la izquierda.
					</p>
					<img src="../../../Utils/imgs/mispedidos_screenshot2.png" class="information-img">
				</td>
			</tr>
			<tr class="information_row" id="tutorial_hacerpedidos">
				<td class="information_col">
					<h2 class="information_col-text-h2">
						Realizar Pedidos
					</h2>
					<p class="information_col-text-p">
						Para realizar pedidos, asegurate de estar en la lengueta correspondiente. Si no te encuentras en ella, busca arriba y a la derecha de la página, donde encontrarás "Pedidos". Hacé click ahí!
					</p>
					<img src="../../../Utils/imgs/pedidos2.png" class="information-img">
					<p class="information_col-text-p">
						Aquí se despliegan dos tablas. Realizar un pedido es tan sencillo como seleccionar los ítems que deseas. 
					</p>
					<img src="../../../Utils/imgs/pedidos_screen.png" class="information-img">
					<p class="information_col-text-p">
						Cada vez que selecciones un ítem del menú, se te pedirá ingresar la cantidad que desees.
					</p>
					<img src="../../../Utils/imgs/prompt.jpg" class="information-img">
					<p class="information_col-text-p">
						Una vez que hayas elegido tu pedido, hacé click en "Enviar" y relajate hasta que toquemos a tu puerta!
					</p>
				</td>
			</tr>
			<tr class="information_row" id="tutorial_otras">
				<td class="information_col">
					<h2 class="information_col-otras" >
						Otras Preguntas Frecuentes:
					</h2>
					<ul>
						<li>
							<h2 class="pregunta">¿Qué pasa si no me gustó la pizza?</h2>
							<p class="respuesta">Y bueno, jodete. Nosotros no devolvemos el dinero.</p>
						</li>
						<li>
							<h2 class="pregunta">¿Puedo retirar mi pizza en el local?</h2>
							<p class="respuesta">Porsupollo!!! Hacé click en la ventana "Contáctenos" para ver nuestro número de teléfono y llamános.</p>
						</li>

						<li>
							<h2 class="pregunta">¿Es verdad que usan carne de perro en vez de peperoni?</h2>
							<p class="respuesta">Para qué quieres saber eso jaja salu2</p>
						</li>
					</ul>
				</td>
			</tr>
		</table>
	</section>
	<footer class="footer">
		<p class="footer-paragraph">2017 © puto el que copia</p>
	</footer>
	<script type="text/javascript" src="../Classes_js/ScrollLink.js"></script>
	<script type="text/javascript" src="../Classes_js/OpinionForm.js"></script>
	<script type="text/javascript" src="../Classes_js/ToggleHeader.js"></script>
	<script type="text/javascript" src="../../Controller/Controller.js"></script>
</body>
</html>