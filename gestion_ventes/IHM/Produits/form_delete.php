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
if ($_SESSION['type_utilisateur'] != 'vendeur') {
    echo 'Seuls les vendeurs peuvent gérer les produits !';
} else {
    // Vérifier si l'identifiant du produit à supprimer est spécifié dans l'URL
    if (isset($_GET['produit_id']) && is_numeric($_GET['produit_id'])) {
        $product_id = $_GET['produit_id'];

        // Afficher le formulaire de suppression
        echo "<h3>Supprimer le produit</h3>";
        echo "<p>Êtes-vous sûr de vouloir supprimer ce produit?</p>";
        echo "<form method='post'>";
        echo "<input type='submit' value='Oui, Supprimer'>";
        echo "</form>";

        // Traitement de la suppression si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = DeleteProduct($product_id);

            if ($result) {
                echo '<p>Produit supprimé avec succès !</p>';
            } else {
                echo '<p>Erreur lors de la suppression du produit.</p>';
            }
        }
    } else {
        echo 'L\'identifiant du produit à supprimer n\'est pas spécifié.';
    }
}

include("../public/footer.php");
?>
