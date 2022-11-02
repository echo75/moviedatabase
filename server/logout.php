<?php
session_start();
include("./includes/session-include.php"); // Session für Loginstatus
date_default_timezone_set('Europe/Berlin');

$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();

$weiterleitung="index.php";
header("Location: $weiterleitung");
exit;
?>
