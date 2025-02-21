<!-- IHM/public/nav_barre.php -->
<nav>
    <ul>
        <li><a href="/gestion_ventes/index.php">Accueil</a></li>
        <li><a href="/gestion_ventes/IHM/Produits/index.php">Produits</a></li>


        <?php
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['username'])) {
            // Si connecté, afficher le lien "Se déconnecter"
            echo '<li><a href="/gestion_ventes/Gestion_Actions/login/logout.php">Se déconnecter</a></li>';
            if (isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur'] =='client'){
                echo '<li><a href="/gestion_ventes/IHM/Commandes/index.php">Mes Commandes</a></li>';
            }

            if(isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur'] == 'vendeur') {
                echo '<li><a href="/gestion_ventes/IHM/Clients/index.php">Clients</a></li>';
            }
        } else {
            // Sinon, afficher les liens "Se connecter" et "S'enregistrer"
            echo '<li><a href="/gestion_ventes/Gestion_Actions/login/login.php">Se connecter</a></li>';
            echo '<li><a href="/gestion_ventes/Gestion_Actions/login/form_add.php">S\'enregistrer</a></li>';
        }
        ?>

        <!-- Ajoutez d'autres liens pour d'autres sections si nécessaire -->
    </ul>
</nav>