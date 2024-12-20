<?php

function returnCnx()
{

    $host = 'localhost';
    $dbname = 'dbusers';
    $user = 'root';
    $password = '';
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



// ----------------------------------------- to create the column photo ------------------------------------------

// $db = returnCnx();

// if ($db) {
//     $sql = "ALTER TABLE Client 
//                 add  photo VARCHAR (255) 

//             ";
//     $db->exec($sql);
//     echo "table editee";
// } else {
//     echo "error avec le BD";
// }

// ----------------------------------------- to drop column photo from table Client ------------------------------------------



// $db = returnCnx();

// if ($db) {
//     $sql = "ALTER TABLE Client 
//                 DROP photo
//             ";
//     $db->exec($sql);
//     echo "column dropped";
// } else {
//     echo "error avec le BD";
// }


// ----------------------------------------- list of clients for tests ------------------------------------------


// $db = returnCnx();

// $query = "INSERT INTO Client (civilite, nom, Prenom, dateNaissance, commune, telephone, courriel, siteWeb, anglais, langues) VALUES
// ('M.', 'Dupont', 'Jean', '1985-06-12', 'Paris', 0145678901, 'jean.dupont@email.fr', 'https://jeandupont.fr', 'Intermediate', 'Français, Anglais'),
// ('Mme', 'Durand', 'Marie', '1990-03-25', 'Lyon', 0478563412, 'marie.durand@email.fr', 'https://mariedurand.fr', 'Fluent', 'Français, Anglais, Espagnol'),
// ('M.', 'Moreau', 'Pierre', '1978-11-05', 'Marseille', 0491234567, 'pierre.moreau@email.fr', 'https://Moreau.fr', 'Basic', 'Français, Italien'),
// ('Mme', 'Petit', 'Sophie', '1995-08-19', 'Toulouse', 0612345678, 'sophie.petit@email.fr', 'https://sophiepetit.fr', 'Advanced', 'Français, Anglais, Allemand'),
// ('M.', 'Lemoine', 'Thomas', '2001-01-10', 'Bordeaux', 0789012345, 'thomas.lemoine@email.fr', 'https://Lemoine.fr', 'Intermediate', 'Français, Anglais')";

// $stmt = $db->prepare($query);
// $stmt->execute();


// ----------------------------------------- alter type ------------------------------------------

// $db = returnCnx();

// if ($db) {
//     $sql = "
//         ALTER TABLE Client 
//         MODIFY COLUMN anglais VARCHAR(255) NULL,
//         MODIFY COLUMN langues VARCHAR(255) NULL;
//     ";

//     try {
//         $db->exec($sql);
//         echo "edit type ok ";
//     } catch (PDOException $e) {
//         echo "error to edit type :" . $e->getMessage();
//     }
// } else {
//     echo "error avec le BD";
// }

// ----------------------------------------- clean table ------------------------------------------

// $db = returnCnx();

// if ($db) {
//     $sql = "TRUNCATE TABLE Client;";

//     try {
//         $stmt = $db->prepare($sql);
//         $stmt->execute();
//         echo "table cleaned";
//     } catch (PDOException $e) {
//         echo "Erro : " . $e->getMessage();
//     }
// }
