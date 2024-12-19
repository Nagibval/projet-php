<?php

function returnCnx()
{

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


// ----------------------------------------- to edit a table ------------------------------------------

// $db = returnCnx();

// if ($db) {
//     $sql = "ALTER TABLE Client 
//                 add  courriel VARCHAR(255) NOT NULL,
//                 add  siteWeb VARCHAR(255) NOT NULL,
//                 add  anglais VARCHAR(255) NOT NULL,
//                 add  langues VARCHAR(255) NOT NULL
//             ";
//     $db->exec($sql);
//     echo "table editee";
// } else {
//     echo "error avec le BD";
// }

// ----------------------------------------- to drop a email ------------------------------------------

// $db = returnCnx();

// if ($db) {
//     $sql = "ALTER TABLE Client 
//                 DROP COLUMN email
//             ";
//     $db->exec($sql);
//     echo "column dropped";
// } else {
//     echo "error avec le BD";
// }

// ----------------------------------------- to create a table ------------------------------------------


// $db = returnCnx();


// if ($db) {
//     $sql = "CREATE TABLE Client (
//                 IdClient INT AUTO_INCREMENT PRIMARY KEY,
//                 civilite VARCHAR(30) NOT NULL,
//                 nom VARCHAR(30) NOT NULL,
//                 Prenom VARCHAR(30) NOT NULL,
//                 dateNaissance DATE NOT NULL,
//                 commune VARCHAR(255),
//                 telephone INT NOT NULL,
//                 courriel VARCHAR(255) NOT NULL,
//                 siteWeb VARCHAR(255) NOT NULL,
//                 anglais VARCHAR(255) NOT NULL,
//                 langues VARCHAR(255) NOT NULL
//             )";

//     $db->exec($sql);
//     echo "Tabela cree";
// } else {
//     echo "error avec le BD";
// }
