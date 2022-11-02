<?php
session_start();
include("./includes/session-include.php"); // Session für Loginstatus
include("./includes/db-parameter.php");

try {
  $pdo = new PDO('mysql:host='.$host.';dbname='.$db.'', $user, $pwd);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = 'INSERT INTO mymovies (id, title, year, imagelink) VALUES ("'. $_POST['imdbid'] .'", "' . $_POST['title'] .'", "' .  $_POST['year'] . '", "' .  $_POST['poster'] . '")';
  // use exec() because no results are returned
  $pdo->exec($sql);
}  catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$pdo = null;
?>
