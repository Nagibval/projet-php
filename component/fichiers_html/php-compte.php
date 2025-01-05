<link rel="stylesheet" href="./bootstrap.min (2).css" />
<?php
require '../../cnxConfig.php';



// Vérification dee la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Hash du mot de passe
    $confirm_mdp = $_POST['confirm_mdp'];




    // Gestion de l'upload de la photo
    $photoPath = ''; //Variable pour stocker le chemin de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        
        $uploadDir = 'upload/';
        
     
        // Nom du fichier photo
        $photoName = basename($_FILES['photo']['name']);
        
        //chemin d'upload complet pour éviter les conflits de noms de fichiers
        $photoPath = $uploadDir . time() . '-' . $photoName;

        // Déplacer la photo téléchargée dans le dossier "upload"
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            echo "Erreur lors de l'upload de la photo.";
            exit;
        }
    }

    function maxidClient() {
        $db = returnCnx();
        $req = $db->query('SELECT MAX(idClient) AS maxId FROM Client');
        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result['maxId'] ?? null;
    }
    $maxidClient = maxidClient();
    if ($maxidClient === null) {
        echo "Erreur : Aucun client trouvé dans la base de données.";
        exit;
    }

    // Connexion à la base de données
    $db = returnCnx();
    if ($db) {
        // Préparer et exécuter la requête d'insertion
        $sql = "INSERT INTO Compte (pseudo, mdp, idClient, photo) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$pseudo, $mdp, $maxidClient, $photoPath]);

        echo "Compte ajouté avec succès !";
    } else {
        echo "Erreur de connexion à la base de données.";
    }
} else {
    echo "Méthode non autorisée.";
}




// Gestion des erreurs
// $errors = [];
// function lookPass($mdp) {
//     if (preg_match('/^(?=.[a-z])(?=.[A-Z])(?=.*[0-9])[\w$@]{6,}$/', ($mdp))==0)
//     {
//         $error[]= "gfsdg";}
// }
// lookPass($mdp);

// echo lookPass("peEss_1");
// Validation du pseudo
// if (strlen($pseudo) < 4) {
//     $errors[] = "Le pseudo doit contenir au moins 4 caractères.";
// }

// // Validation du mot de passe
// if (strlen($mdp) < 6) {
//     $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
// }
// if (!preg_match('/[0-9]/', $mdp)) {
//     $errors[] = "Le mot de passe doit contenir au moins un chiffre.";
// }
// if (!preg_match('/[\W]/', $mdp)) {
//     $errors[] = "Le mot de passe doit contenir au moins un caractère spécial.";
// }

// if (!empty($errors)) {
//     echo "<div class='alert alert-danger'>";
//     echo "<strong>Erreurs :</strong><ul>";
//     foreach ($errors as $error) {
//         echo "<li>$error</li>";
//     }
//     echo "</ul></div>";
//     echo "<div class='text-center'>
//             <button class='btn btn-primary' onclick='history.back()'>Corriger et renvoyer</button>
//           </div>";
//     exit; // Arrête l'exécution si des erreurs sont présentes

// }
