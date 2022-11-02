<?php
session_start();
include("./includes/session-include.php"); // Session für Loginstatus
include("./includes/db-parameter.php");

$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db . '', $user, $pwd);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    $query = $pdo->prepare('INSERT INTO mymovies (id, title, year, imagelink) VALUES (?, ?, ?, ?)');
    $response = $query->execute(array($_POST['id'], $_POST['title'], $_POST['year'], $_POST['imagelink']));
    $pdo = null;
} catch (PDOException $e) {
    echo "DataBase Error:<br>" . $e->getMessage();
} catch (Exception $e) {
    echo "General Error:<br>" . $e->getMessage();
}
