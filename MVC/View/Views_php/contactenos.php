<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Slideshow -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="../../../Utils/css/Fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  	<!-- end del slideshow -->
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/contactenos.css">
	<link rel="stylesheet" type="text/css" href="../../../Utils/css/header.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pizza Cut</title>
</head>
<body id="contactenosHtml">
	<img src="../../../Utils/imgs/backgrnd.jpeg" class="background_img">
	<header class="menu_bar--bs">
		<i id="mobile_bars" class="fa fa-bars fa-2x" aria-hidden="true"></i>
		<div class="menu_bar--bs-link">Tu opinion!</div>
		<form method="POST" class="menu_bar--bs-form">
			<textarea maxlength="250" class="menu_bar-link-textarea" placeholder="Compartinos tu opinion..."></textarea>
			<button type="submit" class="menu_bar-link-btn">Enviar</button>
		</form>
		<a href="#" class="selected menu_bar--bs-link">Contactenos</a>
		<a href="ayuda.php" class="menu_bar--bs-link">Ayuda</a>
		<a href="micuenta.php" class="menu_bar--bs-link">Mi Cuenta</a>	
		<a href="main.php" class="menu_bar--bs-link">Pedidos</a>
		
	</header>

	<section class="side">
		<img src="../../../Utils/imgs/logo.png" class="side-logo">
		<h1 class="side-header">
			Contáctanos:
		</h1>
		<h2 class="side-subheader">
			Pizza Cut
		</h2>
		<p class="side-paragraph">
			Llamanos ahora: 911-666-420<br>
			email: pizzacut@gmail.com<br>
			Av. Cramer 1667<br class="side-paragraph--disableBR">
			Belgrano, Capital Federal, Argentina<br>
		</p>
	</section>

	<section class="map_container">
		<div id="myCarousel" class="carousel slide" data-ride="carousel" >
		    <!-- Indicators -->
		    <ol class="carousel-indicators">
		      	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		      	<li data-target="#myCarousel" data-slide-to="1"></li>
		      	<li data-target="#myCarousel" data-slide-to="2"></li>
		    </ol>
		    <!-- Wrapper for slides -->
		    <div class="carousel-inner">
		      	<div class="item active">
		        	<img src="../../../Utils/imgs/pizzaslider.jpg" style="width:100%;">
		      	</div>

		      	<div class="item">
		        	<img src="../../../Utils/imgs/pizzeriaslider.jpg" style="width:100%;">
		      	</div>
		    
		      	<div class="item">
		        	<img src="../../../Utils/imgs/teamslider.jpg" style="width:100%;">
		      	</div>
		    </div>
		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
		      	<span class="glyphicon glyphicon-chevron-left"></span>
		      	<span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#myCarousel" data-slide="next">
		      	<span class="glyphicon glyphicon-chevron-right"></span>
		      	<span class="sr-only">Next</span>
		    </a>
		</div>
		<div id="map">Google Maps</div>
		<script type="text/javascript" src="../../../Utils/js/mapa.js"></script>
 		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzWGQhRAV8Y_VD8oSE1Xes6Sy4_-brm5E&callback=initMap"></script>
	</section>
	<footer class="footer">
		<img src="../../../Utils/imgs/logo.png" alt="" class="footer-img">
		<p class="footer-paragraph">2017 © puto el que copia</p>
	</footer>
	<script type="text/javascript" src="../Classes_js/OpinionForm.js"></script>
	<script type="text/javascript" src="../Classes_js/ToggleHeader.js"></script>
	<script type="text/javascript" src="../../Controller/Controller.js"></script>
</body>
</html>