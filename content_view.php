<link rel="stylesheet" href="./component/fichiers_html/bootstrap.min (2).css" />
<?php

// Requete: selection (select)
require_once("cnxConfig.php");
$db = returnCnx();

try {


    $req = $db->query('select * from Client');

    if ($req->rowCount() > 0) {
        echo "<div class='m-5 p-3 bg-light rounded'>";
        echo "<h3>Table Data:</h3>";
        echo "<table class='table table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='text-center'>IdClient</th>";
        echo "<th class='text-center'>Nome</th>";
        echo "<th class='text-center'>Prénom</th>";
        echo "<th class='text-center'>Telephone</th>";
        echo "<th class='text-center'>Email</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($data = $req->fetch()) {
            echo "<tr>";
            echo "<td class='text-center'>"  . $data['IdClient'] . "</td>";
            echo "<td class='text-center'>" . $data['nom'] . "</td>";
            echo "<td class='text-center'>" . $data['Prenom'] . "</td>";
            echo "<td class='text-center'>" . $data['telephone'] . "</td>";
            echo "<td class='text-center'>" . $data['courriel'] . "</td>";

           
            echo "</tr>";
        }


        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='m-5 p-3 bg-light rounded'>";
        echo "<h3>Table Data:</h3>";
        echo "<p>Il n'y a pas de données dans le tableau.</p>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

echo "<button type='button' class='btn btn-primary m-3' onclick=\"window.location.href='../projet-php/component/fichiers_html/php-form.html'\">Formulaire Client</button><br>";
