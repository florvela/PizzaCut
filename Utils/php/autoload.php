<?php
spl_autoload_register(function($className) {
	if(file_exists('php/clases/'.$className.'.php')) {
		require_once 'php/clases/'.$className.'.php';
	}
});