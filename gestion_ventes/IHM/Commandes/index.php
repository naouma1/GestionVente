<?php
session_start();
include("../public/header.php");
include("../public/nav_barre.php");


// Inclure le fichier de base de données pour les commandes
include("../../Access_BD/commandes.php");


// Vérifiez si l'utilisateur est connecté
if (!$_SESSION['username']) {
    header("Location: ../../Gestion_Actions/login/login.php"); // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérifiez si l'utilisateur est connecté
if ($_SESSION['type_utilisateur']=='vendeur') {
    echo 'Seuls les clients peuvent voir cette page de commandes';
    exit();
}
// Récupérez les commandes de l'utilisateur depuis la base de données

    $commandes = getCommandesByUserId ($_SESSION['id_utilisateur']);


?>


<h1>Mes Commandes</h1>

<?php if ($commandes): ?>
    <table>
        <tr>
            <th>Numéro de commande</th>
            <th>Nom du produit</th>
            <th>Quantité</th>
            <th>Prix</th>
        </tr>
        <body>
        <?php foreach ($commandes as $commande): ?>
            <tr>
                <td><?php echo $commande['id_commande']; ?></td>
                <td><?php echo $commande['nom_produit']; ?></td>
                <td><?php echo $commande['quantite_commande']; ?></td>
                <td><?php echo $commande['total_prix']; ?></td>

            </tr>
        <?php endforeach; ?>
        </body>
    </table>
<?php else: ?>
    <p>Aucune commande trouvée.</p>
<?php endif; ?>
<?php
include("../public/footer.php");
?>
<!-- Inclure
