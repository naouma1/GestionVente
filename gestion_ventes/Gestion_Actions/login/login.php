<?php
include("../../IHM/public/header.php");
include("../../IHM/public/nav_barre.php");
include("../../Access_BD/clients.php");
?>
<body>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Appeler la fonction d'authentification
    if (AuthenticateUser($username, $password)) {
        $_SESSION['username'] = $username;

        // Récupérer le type d'utilisateur
        $userType = GetUserType($username);

        // Rediriger en fonction du type d'utilisateur
        if ($userType === 'client') {
            header('Location: ../../IHM/Produits/index.php');
        } elseif ($userType === 'vendeur') {
            header('Location: ../../index.php');
        } else {
            // Gérer un type d'utilisateur non reconnu
            echo "Type d'utilisateur non reconnu.";
        }

        exit;
    } else {
        echo "<div class='form'>
                  <h3>Nom d'utilisateur ou Mot de passe incorrect</h3><br/>
                  <p class='link'>Cliquer ici pour <a href='login.php'>se connecter</a></p>
                  </div>";
    }
} else {
    ?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Se connecter</h1>
        <input type="text" class="login-input" name="username" placeholder="Nom d'utilisateur" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Se connecter" name="submit" class="login-button"/>
        <p class="link"><a href="form_add.php">Nouvelle inscription</a></p>
    </form>
    <?php
}
?>
</body>
<?php include("../../IHM/public/footer.php"); ?>
