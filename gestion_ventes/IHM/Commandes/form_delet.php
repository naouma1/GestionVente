<?php
session_start();
include("../public/header.php");
include("../public/nav_barre.php");

// Inclure le fichier de base de données pour les commandes
include("../../Access_BD/produits.php");

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['username'])) {
    header('Location: ../login/login.php');
    exit;
}

// Vérifier si l'utilisateur est un vendeur
if ($_SESSION['type_utilisateur'] != 'client') {
    echo 'Seuls les clients supprimer la commande !';
} else {
    // Vérifier si l'identifiant du produit à supprimer est spécifié dans l'URL
    if (isset($_GET['commande_id']) && is_numeric($_GET['commande_id'])) {
        $commande_id = $_GET['commande_id'];

        // Afficher le formulaire de suppression
        echo "<h3>Supprimer la commande</h3>";
        echo "<p>Êtes-vous sûr de vouloir supprimer cette commande?</p>";
        echo "<form method='post'>";
        echo "<input type='submit' value='Oui, commande_id'>";
        echo "</form>";

        // Traitement de la suppression si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = DeleteCommande($commande_id);

            if ($result) {
                echo '<p>Produit supprimé avec succès !</p>';
            } else {
                echo '<p>Erreur lors de la suppression de la commande.</p>';
            }
        }
    } else {
        echo 'L\'identifiant du produit à supprimer n\'est pas spécifié.';
    }
}

include("../public/footer.php");
?>