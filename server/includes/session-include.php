<?php
session_start();
date_default_timezone_set('Europe/Berlin');

if (!isset($_SESSION['ok_logged_in']) || $_SESSION['ok_logged_in'] != true) {
	header ('Location: index.php');
}


$verfallszeit = 3600; # 60sek * 60min ->60 Minuten -> 1h
$neu = time();
if (! isset($_SESSION['letzter_kontakt']))
  $_SESSION['letzter_kontakt'] = $neu;
if ($neu - $_SESSION['letzter_kontakt'] > $verfallszeit) {
	# rausschmeißen
	# Session Daten löschen
	   $_SESSION = array();
	# Keks nicht vergessen
	if (isset($_COOKIE[session_name()])) {
	    setcookie(session_name(), '', time()-42000, '/');
	# Löschen der Session
	   session_destroy();
		header ('Location: index.php'); # zurück zur Loginseite
	   exit;
	}
}
#Wer hier noch da ist, ist entweder neu oder hat weniger als 5' getrödelt
$_SESSION['letzter_kontakt'] = $neu;
# weiter im Script
?>
