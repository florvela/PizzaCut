<?php

date_default_timezone_set( "America/Argentina/Buenos_Aires" );

session_start( );

function cambiar_formato($fecha,$b){
	$datetime = new DateTime($fecha);
	if($b){
		return $datetime->format('d/m/Y');
	}
	else{
		return $datetime->format('H:i d/m/Y');
	}
}

function getDatetimeNow() {
	$tz_object = new DateTimeZone('America/Argentina/Buenos_Aires');
	$datetime = new DateTime();
	$datetime->setTimezone($tz_object);
	return $datetime->format('Y-m-d\TH:i:s.u');
}
?>