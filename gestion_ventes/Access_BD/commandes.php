<!-- Access_BD/commandes.php -->
<?php

require("produits.php");

// Fonction pour insérer une commande dans la base de données
function PlaceOrder($userId, $productId, $quantity)
{
    $conn = Connect();
    // Récupérer les détails du produit pour vérifier la quantité dans le stock et pour calculer le prix de la commande
    $product = GetProductById($productId);

    if (!$product) {
        return "Produit non trouvé.";
    }

    // Vérifier la disponibilité en stock
    if ($quantity > $product['quantite_stock']) {
        echo "Stock insuffisant pour le produit : {$product['nom_produit']}.";
        return false;
    }

    // Calculer le total de la commande
    $totalPrice = $quantity * $product['prix'];

    // Insérer la commande dans la base de données
    $query = "INSERT INTO commandes (id_utilisateur, id_produit, quantite_commande, total_prix) 
              VALUES ('$userId', '$productId', '$quantity', '$totalPrice')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Mettre à jour la quantité en stock
        $newStock = $product['quantite_stock'] - $quantity;
        $updateQuery = "UPDATE produits SET quantite_stock='$newStock' WHERE id_produit='$productId'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            echo "Commande passée avec succès !";
            return true;
        } else {
            echo "Erreur lors de la mise à jour du stock.";
            return false;
        }
    } else {
        echo "Erreur lors de l'enregistrement de la commande.";
        return false;
    }
}

// Fonction pour obtenir les commandes par id utilisateur
function getCommandesByUserId($user_id)
{
    $conn = Connect();
    $query = "SELECT commandes.id_commande, produits.nom_produit, commandes.quantite_commande, commandes.total_prix
              FROM commandes
              INNER JOIN produits ON commandes.id_produit = produits.id_produit
              WHERE commandes.id_utilisateur = '$user_id'";
    $result = mysqli_query($conn, $query);

    return $result;
}




?>
