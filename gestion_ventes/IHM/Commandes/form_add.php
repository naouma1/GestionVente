<?php
session_start();
include("../public/header.php");
include("../public/nav_barre.php");

// Inclure le fichier de base de données pour les commandes
include("../../Access_BD/commandes.php");

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['username'])) {
    header('Location: ../login/login.php');
    exit;
}

// Vérifier si l'identifiant du produit est présent dans l'URL
if (isset($_GET['produit_id'])) {
    $productId = $_GET['produit_id'];
    $product = GetProductById($productId);

    if ($product) {
        echo "<div class='container'>";
        echo "<h2>Commander le produit : {$product['nom_produit']}</h2>";
        ?>
        <form method="post">
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantity" required>
            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
            <input type="submit" value="Valider la commande">
        </form>
        <?php
        echo "<a href='../../IHM/Produits/index.php'>Retour aux produits</a>";
        echo "</div>";
    } else {
        echo "<p>Produit non trouvé.</p>";
    }
} else {
    echo "<p>Identifiant du produit non spécifié.</p>";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $userId = $_SESSION['id_utilisateur'];
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantite'];

    // Appeler la fonction pour insérer la commande dans la base de données
    $result = PlaceOrder($userId, $productId, $quantity);

    // Afficher le résultat
    if ($result) {
        echo "<p>Commande passée avec succès !</p>";
    } else {
        echo "<p>Erreur lors du passage de la commande.</p>";
    }
}
?>



<?php
include("../public/footer.php");
?>
