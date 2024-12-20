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
    //--------------------------------------------------------------------------


    $error = [];

    if ($Civilite == "") {
        $error[] = "Vous devez choisir une <strong>Gênero</strong>.";
    }
    if (preg_match('/\d/', $nom) || preg_match('/\d/', $prenom)) {
        $error[] = "Les champs <strong>Nom</strong> et <strong>Prénom</strong> ne peuvent pas contenir de chiffres.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "L'adresse e-mail n'est pas valide.";
    }
    if (!preg_match('/^[0-9]{10}$/', $Telephone)) {
        $error[] = "Le numéro de téléphone doit contenir uniquement 10 chiffres.";
    }
    if (!DateTime::createFromFormat('Y-m-d', $date_naissance) || $date_naissance > date('Y-m-d')) {
        $error[] = "La date de naissance est invalide.";
    }

    if (!empty($error)) {
        echo "<div class='alert alert-danger m-5 p-3'>";
        echo "<strong>Erreur :</strong><ul>";
        foreach ($error as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul></div>";
        echo "<div class='text-center'>
                <button class='btn btn-primary' onclick='history.back()'>Corriger et renvoyer</button>
              </div>";
        exit;
    }
}


echo "<div class='m-5 p-3 bg-light rounded'>";
echo "<h3>Données de Formulaire:</h3>";
echo "<p><strong>Civilité :</strong> " . $Civilite . "</p>";
echo "<p><strong>Nom :</strong> " . $nom . "</p>";
echo "<p><strong>Prénom :</strong> " . $prenom . "</p>";
echo "<p><strong>Date de Naissance :</strong> " . $date_naissance . "</p>";
echo "<p><strong>Commune de Naissance :</strong> " . $commune_naissance . "</p>";
echo "<p><strong>Ville :</strong> " . $ville . "</p>";
echo "<p><strong>Téléphone :</strong> " . $Telephone . "</p>";
echo "<p><strong>Email :</strong> " . $email . "</p>";
echo "<p><strong>Site Web :</strong> " . $siteWeb . "</p>";
echo "<p><strong>Anglais :</strong> " . $anglais . "</p>";
echo "<p><strong>Préférences (Langages) :</strong> " . implode(", ", $langages) . "</p>";
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
        ':langages' => implode(", ", $langages),
    ]);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
