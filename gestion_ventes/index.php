<!-- Index.php -->
<?php
include("IHM/public/header.php");
include("IHM/public/nav_barre.php");
include("Access_BD/connexion.php");

$conn = Connect();
?>
<body>
<!-- Page d'accueil -->
<div>
    <h1>Bienvenue sur notre magasin de PC portables et de bureaux</h1>
    <!-- Autres informations nécessaires -->
    <div class="center-image">
    <img src="IHM/public/images/desks_laptops.png" alt="Homepage Image" class="homepage-image">
    </div>
    <!-- Liste des produits avec possibilité de promotion -->
</div>
</body>

<?php
include("IHM/public/footer.php");
?>

