<?php
session_start();

include("../public/header.php");
include("../public/nav_barre.php");

// Inclure les fichiers de base de données nécessaires
include("../../Access_BD/produits.php");

// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
if (!isset($_SESSION['username'])) {
    header('Location: ../login/login.php');
    exit;
}

// Nom d'utilisateur
$username = $_SESSION['username'];
?>

<body>
<div class="container">
    <h2>Bonjour <?php echo $username; ?> !</h2>
    <div>
        <h3>Produits disponibles</h3>
    </div>

    <?php
    // Appel à la fonction Afficher les produits
    $products = GetAllProducts();

    if ($products) {
    echo "<ul>";
    foreach ($products as $product) {
        echo "<li>";
        echo "<img src='../../{$product['photo_produit']}' ' style='max-width: 400px; max-height: 400px;'>";

        echo "<h5>{$product['nom_produit']} - {$product['prix']}$</h5>";
        echo "<p>{$product['description']}</p>";


        echo "<a href='../Commandes/form_add_test.php?produit_id={$product['id_produit']}'>Commander</a>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucun produit disponible.</p>";
}?>

    <br>
    <a href="../../index.php">Déconnexion</a>
</div>
</body>

<?php include("../public/footer.php"); ?>
