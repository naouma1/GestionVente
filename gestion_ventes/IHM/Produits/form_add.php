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

if ($_SESSION['type_utilisateur']!='vendeur'){
    echo 'Seuls les vendeurs peuvent ajouter un produit !';
}
else{
    ?>
    <form method="post">
        <h3>Entrer les détails du produits</h3>
        <input type="text" name="nom_produit", placeholder="Nom du Produit">
        <input type="text" name="description", placeholder="Description du produit">
        <input type="number" name="prix", placeholder="Prix de l'unité">
        <input type="number" name="quantite_stock", placeholder="Quantité du stock">
        <input type="file" name="photo" id="photo" accept="image/*">
        <input type="submit" value="Ajouter le produit">
    </form>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $nomProduit = $_POST['nom_produit'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $quantite = $_POST['quantite_stock'];

//Appel a la fonction AddProduct
        $result = AddProduct($nomProduit, $description, $prix, $quantite);

        if ($result) {
            echo 'Produit Ajouté avec succès !';
        }
    }
}

include("../public/footer.php");
?>

