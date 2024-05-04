<?php

$passwort = "admin";
$gehashtesPasswort = password_hash($passwort, PASSWORD_DEFAULT);
echo $gehashtesPasswort . "\n";
