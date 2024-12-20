<link rel="stylesheet" href="./component/fichiers_html/bootstrap.min (2).css" />

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Civilite = isset($_POST["Civilité"]) ? htmlspecialchars($_POST["Civilité"]) : '';
    $nom = isset($_POST["nom"]) ? htmlspecialchars($_POST["nom"]) : '';
    $prenom = isset($_POST["prenom"]) ? htmlspecialchars($_POST["prenom"]) : '';
    $date_naissance = isset($_POST["date_naissance"]) ? htmlspecialchars($_POST["date_naissance"]) : '';
    $commune_naissance = isset($_POST["commune_naissance"]) ? htmlspecialchars($_POST["commune_naissance"]) : '';
    $ville = isset($_POST["Ville"]) ? htmlspecialchars($_POST["Ville"]) : '';
    $Telephone = isset($_POST["Téléphone"]) ? htmlspecialchars($_POST["Téléphone"]) : '';
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : '';
    $siteWeb = isset($_POST["SiteWeb"]) ? htmlspecialchars($_POST["SiteWeb"]) : '';
    $anglais = isset($_POST["anglais"]) ? htmlspecialchars($_POST["anglais"]) : '';
    $langages = isset($_POST["langages"]) && is_array($_POST["langages"]) ? $_POST["langages"] : [];
}


echo "<div class='m-5 p-3 bg-light rounded'>";
echo "<h3>Dados Recebidos:</h3>";
echo "<p><strong>Gênero:</strong> " . $Civilite . "</p>";
echo "<p><strong>Nome:</strong> " . $nom . "</p>";
echo "<p><strong>Primeiro Nome:</strong> " . $prenom . "</p>";
echo "<p><strong>Data de Nascimento:</strong> " . $date_naissance . "</p>";
echo "<p><strong>Comuna de Nascimento:</strong> " . $commune_naissance . "</p>";
echo "<p><strong>Cidade:</strong> " . $ville . "</p>";
echo "<p><strong>Telefone:</strong> " . $Telephone . "</p>";
echo "<p><strong>Email:</strong> " . $email . "</p>";
echo "<p><strong>Site:</strong> " . $siteWeb . "</p>";
echo "<p><strong>Inglês:</strong> " . $anglais . "</p>";
echo "<p><strong>Preferências (Linguagens):</strong> " . implode(", ", $langages) . "</p>";
echo "</div>";


// echo "<pre>";
// echo "<div class='m-5 p-3 bg-light rounded'>";
// echo var_dump($GLOBALS);
// echo "<pre/>";
// echo "</div>";



// Requete: insertion (insert)
require_once("cnxConfig.php");
$db = returnCnx();
try {
    // using a prepared statement and substitution marks

    $query = 'INSERT INTO Client (civilite, nom, Prenom, dateNaissance, commune, telephone, courriel, siteWeb, anglais, langues) 
              VALUES (:civilite, :nom, :prenom, :dateNaissance, :commune, :telephone, :courriel, :siteWeb, :anglais, :langages)';
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':civilite' => $Civilite,
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':dateNaissance' => $date_naissance,
        ':commune' => $commune_naissance,
        ':telephone' => $Telephone,
        ':courriel' => $email,
        ':siteWeb' => $siteWeb,
        ':anglais' => $anglais,
        ':langages' => implode(", ", $langages), // Salvando como string
    ]);
    echo "<p>Données insérées avec succès !</p>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
