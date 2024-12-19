<?php

function returnCnx(){

$host = 'localhost';
$dbname = 'dbusers';
$user = 'root';
$password = 'root';
try {
    $connexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
 return $connexion;
}

