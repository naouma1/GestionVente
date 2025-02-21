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
    echo 'Seuls les vendeurs peuvent modifier un produit !';
} else {
    // Vérifier si l'identifiant du produit à modifier est présent dans l'URL
    if (isset($_GET['produit_id']) && is_numeric($_GET['produit_id'])) {
        $product_id = $_GET['produit_id'];
        $product = GetProductById($product_id);

        if ($product){
            // Traitement du formulaire d'édition
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nomProduit = $_POST['nom_produit'];
                echo $nomProduit;
                $description = $_POST['description'];
                $prix = $_POST['prix'];
                $quantite = $_POST['quantite_stock'];


                // Mettez à jour les détails du produit dans la base de données
                $result = UpdateProduct($product_id, $nomProduit, $description, $prix, $quantite);

                if ($result) {
                    echo 'Produit mis à jour avec succès !';
                } else {
                    echo 'Erreur lors de la mise à jour du produit dans la base de données.';
                }
            }

            // Formulaire de modification de produit avec les détails actuels du produit
            ?>

            <form method="post">
                <h3>Modifier les détails du produit</h3>
                <input type="text" name="nom_produit" placeholder="Nom du Produit" value="<?php echo $product['nom_produit']; ?>">
                <input type="text" name="description" placeholder="Description du produit" value="<?php echo $product['description']; ?>">
                <input type="number" name="prix" placeholder="Prix de l'unité" value="<?php echo $product['prix']; ?>">
                <input type="number" name="quantite_stock" placeholder="Quantité du stock" value="<?php echo $product['quantite_stock']; ?>">
                <input type="file" name="photo" id="photo" accept="image/*">
                <input type="submit" value="Modifier le produit">
            </form>

            <?php
        } else {
            echo 'Produit non trouvé.';
        }
    } else {
        echo 'L\'identifiant du produit à éditer n\'est pas spécifié.';
    }
}

include("../public/footer.php");
?>
