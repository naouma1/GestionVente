<?php
session_start();

include("../public/header.php");
include("../public/nav_barre.php");

// Inclure les fichiers de base de données nécessaires
include("../../Access_BD/clients.php");
?>


        <h2>La liste des clients</h2>
<?php
//Appel à la fonction Pour obtenir tous les produits
$clients = GetAllClients();
if ($clients){ ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Ville</th>
                        <th>Email</th>
                    </tr>
                    <body>

                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo $client['id_client']; ?></td>
                            <td><?php echo $client['nom_client']; ?></td>
                            <td><?php echo $client['telephone_client']; ?></td>
                            <td><?php echo $client['ville_client']; ?></td>
                            <td><?php echo $client['email_client']; ?></td>

                        </tr>
                    <?php endforeach; }?>
</div>
</body>
</table>





<?php include("../public/footer.php"); ?>