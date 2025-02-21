<?php
session_start();

include("../public/header.php");
include("../public/nav_barre.php");

// Inclure les fichiers de base de données nécessaires
include("../../Access_BD/produits.php");
?>

<body>
<div class="container">
    <div>
        <h3>Produits disponibles</h3>
    </div>
<?php
if (isset($_SESSION['username']) && $_SESSION['type_utilisateur']=='vendeur') {
    echo "<a href='form_add.php'><button type='button' onclick=''>Ajouter un nouveau produit</button></a>";
}

// Afficher les produits
$products = GetAllProducts();

if ($products) {
    echo "<ul>";
    foreach ($products as $product) {
        echo "<li>";
        echo "<img src='../../{$product['photo_produit']}' ' style='max-width: 400px; max-height: 400px;'>";

        echo "<h5>{$product['nom_produit']} - {$product['prix']}$</h5>";
        echo "<p>{$product['description']}</p>";

        if (isset($_SESSION['username']) && $_SESSION['type_utilisateur']==='client') {
            echo "<a href='../Commandes/form_add.php?produit_id={$product['id_produit']}'>Commander</a>";
        }
        if (isset($_SESSION['username']) && $_SESSION['type_utilisateur']==='vendeur') {
            echo "<p><a href='../Produits/form_edit.php?produit_id={$product['id_produit']}'>Editer</a></p>";

            echo "<p><a href='../Produits/form_delete.php?produit_id={$product['id_produit']}'>Supprimer</a></p>";
        }

        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucun produit disponible.</p>";
}

?>

    <br>
</div>
</body>

<?php include("../public/footer.php"); ?>
