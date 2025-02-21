<?php
include("connexion.php");
//Fonction Pour obtenir tous les produits
function GetAllProducts()
{
    $conn = Connect();
    // Récupérer tous les produits depuis la base de données
    $query = "SELECT * FROM produits WHERE quantite_stock>0";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Convertir le résultat en tableau
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $products;
    } else {
        return false;
    }
}
//Fonction pour obtenir les produis par id_produit
function GetProductById($productId)
{
    $conn = Connect();
    // Récupérer les détails du produit par son ID
    $query = "SELECT * FROM produits WHERE id_produit='$productId'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result)) {
        return mysqli_fetch_assoc($result);
    }
    else{
        return false;
    }
}

// Fonction pour ajouter un produit sur la base de données
function AddProduct($nomProduit, $description, $prix, $quantite)
{
    $conn = Connect();
    $sql = "INSERT INTO Produits(nom_produit, description, prix, quantite_stock)
            VALUES ('$nomProduit', '$description', '$prix', '$quantite')";
    $result = mysqli_query($conn, $sql);
    if ($result){
        return true;
    }
}

// Fonction pour mettre à jour un produit dans la base de données
function UpdateProduct($product_id, $nomProduit, $description, $prix, $quantite) {
    $conn = Connect();

    // Requête SQL pour mettre à jour le produit dans la base de données
    $query = "UPDATE produits SET nom_produit = '$nomProduit', description = '$description', prix = $prix, quantite_stock = $quantite WHERE id_produit = $product_id";

    // Exécuter la requête
    $result = mysqli_query($conn, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Fonction pour supprimer un produit de la base de données
function DeleteProduct($product_id) {
    $conn = Connect();

    // Requête SQL pour supprimer le produit de la base de données
    $query = "DELETE FROM produits WHERE id_produit = $product_id";

    // Exécuter la requête
    $result = mysqli_query($conn, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}
?>
