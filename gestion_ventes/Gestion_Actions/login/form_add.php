<?php
// Inclure l'entête et la barre de navigation
include("../../IHM/public/header.php");
include("../../IHM/public/nav_barre.php");

// Inclure le fichier de connexion à la base de données
include("../../Access_BD/clients.php");

// Lorsque le formulaire est soumis, insérer les valeurs dans la base de données
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['user_type'];// Ajout du champ pour le type de client
    $ville = $_POST['ville'];
    $telephone = $_POST['telephone'];

    // Appeler la fonction d'inscription
    $result = RegisterUser($username, $password, $email, $userType, $ville, $telephone); // Utiliser md5 pour hasher le mot de passe
    // Afficher le résultat
    echo $result;
} else {
    ?>
    <form class="form" action="" method="POST">
        <h1 class="login-title">Inscription</h1>
        <input type="text" class="login-input" name="username" placeholder="Nom d'utilisateur" required />
        <input type="text" class="login-input" name="email" placeholder="Adresse Email" required>
        <input type="tel" class="login-input" name="telephone" placeholder="telephone" required/>
        <input type="text" class="login-input" name="ville" placeholder="ville" required/>
        <input type="password" class="login-input" name="password" placeholder="Mot de passe" required>
        <label for="user_type">Type de client :</label>
        <select name="user_type" required>
            <option value="client">Client</option>
        </select>
        <input type="submit" name="submit" value="S'inscrire" class="login-button">
        <p class="link"><a href="login.php">Cliquez ici pour vous connecter</a></p>
    </form>
    <?php
}

// Inclure le fichier de pied de page
include("../../IHM/public/footer.php");
?>
