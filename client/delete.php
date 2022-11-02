<?php
session_start();
include("./includes/session-include.php"); // Session für Loginstatus
include("./includes/db-parameter.php");

$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db . '', $user, $pwd);
// set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
$query = $pdo->prepare('DELETE FROM mymovies WHERE id = ?');
$response = $query->execute(array($_POST['id']));
$pdo = null;
} catch (PDOException $e) {
    echo "DataBase Error: The user could not be added.<br>" . $e->getMessage();
} catch (Exception $e) {
    echo "General Error: The user could not be added.<br>" . $e->getMessage();
}