<link rel="stylesheet" href="./component/fichiers_html/bootstrap.min (2).css" />

<?php

// checks if the form was submitted using the POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // to verify if it exists in the $_POST array before processing it  - if isset is true -  is applied to sanitize the input end if isset is false -  the string is empty.
    $Civilite = isset($_POST["Civilité"]) ? htmlspecialchars($_POST["Civilité"]) : '';
    $nom = isset($_POST["nom"]) ? htmlspecialchars($_POST["nom"]) : '';
    $prenom = isset($_POST["prenom"]) ? htmlspecialchars($_POST["prenom"]) : '';
    $date_naissance = isset($_POST["date_naissance"]) ? htmlspecialchars($_POST["date_naissance"]) : '';
    $commune_naissance = isset($_POST["commune_naissance"]) ? htmlspecialchars($_POST["commune_naissance"]) : '';
    $Telephone = isset($_POST["Téléphone"]) ? htmlspecialchars($_POST["Téléphone"]) : '';
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : '';
    $siteWeb = isset($_POST["SiteWeb"]) ? htmlspecialchars($_POST["SiteWeb"]) : '';
    $anglais = isset($_POST["anglais"]) ? htmlspecialchars($_POST["anglais"]) : '';
    // here we check if the 'langages' is a valid array, if it is not we set it to an empty array - whi
    $langages = isset($_POST["langages"]) && is_array($_POST["langages"]) ? $_POST["langages"] : [];

    //----------------------------------------------------------------------------------------------------------------


    $error = [];

    if ($Civilite == "") {
        $error[] = "Vous devez choisir une <strong>Gênero</strong>.";
    }
    // preg_match - looks for a number with the '/\d/' : returns true or false and strlen get a string length
    if (preg_match('/\d/', $nom) || preg_match('/\d/', $prenom) || strlen($nom) < 3 || strlen($prenom) < 3) {
        $error[] = "Les champs <strong>Nom</strong> et <strong>Prénom</strong> ne peuvent pas contenir de chiffres. Et plus de 3 caractères.";
    }
    // if the email is not valid the filter_var returns false, but we use the ! to make it true
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "L'adresse e-mail n'est pas valide.";
    }
    // we look for a number with 10 digits and we check if it is 0-9
    if (!preg_match('/^[0-9]{10}$/', $Telephone)) {
        $error[] = "Le numéro de téléphone doit contenir uniquement 10 chiffres.";
    }
    // to create a date object with format Y-m-d if it valid, like a date that returns a object. we cgeck also if the date is in the future
    if (!DateTime::createFromFormat('Y-m-d', $date_naissance) || $date_naissance > date('Y-m-d')) {
        $error[] = "La date de naissance est invalide.";
    }

    $birthdate = DateTime::createFromFormat('Y-m-d', $date_naissance);
    //  to get the current date 
    $now = new DateTime();
    // to calculate the difference between the two dates
    $interval = $now->diff($birthdate);
    if ($interval->y > 100) {
        $error[] = "Vous devez avoir moins de 100 ans.";
    }

    require_once("cnxConfig.php");
    $db = returnCnx();
    $req = $db->query('select * from Client');

    if ($req->rowCount() > 0) {
        while ($data = $req->fetch()) {
            //  if it's match we add an error
            if ($data['nom'] == $nom && $data['Prenom'] == $prenom && $email == $data['courriel']) {
                $error[] = "Ce client est deja dans la base de données";
                break;
            }
        }
    }
    // to get and show the errors 
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

//  her we will show the client informations 

echo "<div class='m-5 p-3 bg-light rounded'>";
echo "<h3>Données de Formulaire:</h3>";
echo "<p><strong>Civilité :</strong> " . $Civilite . "</p>";
echo "<p><strong>Nom :</strong> " . $nom . "</p>";
echo "<p><strong>Prénom :</strong> " . $prenom . "</p>";
echo "<p><strong>Date de Naissance :</strong> " . $date_naissance . "</p>";
echo "<p><strong>Commune de Naissance :</strong> " . $commune_naissance . "</p>";
echo "<p><strong>Téléphone :</strong> " . $Telephone . "</p>";
echo "<p><strong>Email :</strong> " . $email . "</p>";
echo "<p><strong>Site Web :</strong> " . $siteWeb . "</p>";
echo "<p><strong>Anglais :</strong> " . $anglais . "</p>";
echo "<p><strong>Préférences (Langages) :</strong> " . implode(", ", $langages) . "</p>";
echo "</div>";


echo "<button type='button' class='btn btn-primary m-3' onclick=\"window.location.href='content_view.php'\">Données</button><br>";


// echo "<pre>";
// echo "<div class='m-5 p-3 bg-light rounded'>";
// echo var_dump($GLOBALS);
// echo "<pre/>";
// echo "</div>";

// Requete: insertion (insert)
require_once("cnxConfig.php");
$db = returnCnx();
try {
    // using a prepared statement and substitution marks ofr security
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
