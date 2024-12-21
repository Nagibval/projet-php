<?php
// require 'cnxConfig.php'; // Inclure la connexion à la base de données
require '../../cnxConfig.php'; // Si 'cnxConfig.php' est deux dossiers au-dessus



// Vérification que la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Hash du mot de passe
    $idClient = $_POST['idClient'];

    // Gestion de l'upload de la photo
    $photoPath = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        // Dossier où les photos sont stockées
        $uploadDir = 'upload/';
        
     
        // Nom du fichier photo
        $photoName = basename($_FILES['photo']['name']);
        
        // Créer un chemin d'upload complet pour éviter les conflits de noms de fichiers
        $photoPath = $uploadDir . time() . '-' . $photoName;

        // Déplacer la photo téléchargée dans le dossier "upload"
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            echo "Erreur lors de l'upload de la photo.";
            exit;
        }
    }

    // Connexion à la base de données
    $db = returnCnx();
    if ($db) {
        // Préparer et exécuter la requête d'insertion
        $sql = "INSERT INTO Compte (pseudo, mdp, idClient, photo) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$pseudo, $mdp, $idClient, $photoPath]);

        echo "Compte ajouté avec succès !";
    } else {
        echo "Erreur de connexion à la base de données.";
    }
} else {
    echo "Méthode non autorisée.";
}
