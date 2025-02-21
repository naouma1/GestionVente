<?php
include("connexion.php");

// Fonction pour enregistrer un nouveau utilisateur
function RegisterUser($nomUtilisateur, $motDePasse, $email, $typeUtilisateur, $ville, $telephone)
{
    $conn = Connect();

    // Valider les entrées
    if (empty($nomUtilisateur) || empty($motDePasse) || empty($email) || empty($typeUtilisateur)) {
        return "Tous les champs sont obligatoires";
    }

    // la requête SQL d'insertion dans la table utilisateurs
    $sql_utilisateur = "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, email, type_utilisateur) 
            VALUES ('$nomUtilisateur', '$motDePasse', '$email', '$typeUtilisateur')";

    $result_utilisateur = mysqli_query($conn, $sql_utilisateur);

    // Récupérer l'id de l'utilisateur
    $id_utilisateur = mysqli_insert_id($conn);
    $sql_client = "INSERT INTO clients (id_utilisateur, nom_client, email_client,ville_client, telephone_client)
                    VALUES ('$id_utilisateur','$nomUtilisateur','$email','$ville','$telephone')";

    // Exécuter la requête

    $result_client = mysqli_query($conn, $sql_client);


    if ($result_client && $result_utilisateur){
        // Fermer la connexion à la base de données
        mysqli_close($conn);
        return "Inscription réussite !!";
        }
    else{
        mysqli_close($conn);
        return "Problème d'enregistrement";
    }
}

// Fonction qui connecte l'utilisateur s'il existe sur la base de donnée
function AuthenticateUser($username, $password)
{
    $conn = Connect();

    $query = "SELECT * FROM utilisateurs WHERE nom_utilisateur='$username' AND mot_de_passe='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // L'utilisateur existe dans la base de données
        $user = mysqli_fetch_assoc($result);
        // Stocker l'ID de l'utilisateur dans la session
        $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
        $_SESSION['type_utilisateur'] = $user['type_utilisateur'];
        return true;
    } else {
        // L'utilisateur n'existe pas ou les identifiants sont incorrects
        return false;
    }
}

// Fonction pour obtenir le type d'utilisateur
function GetUserType($username) {
    $conn = Connect();

    $query = "SELECT type_utilisateur FROM utilisateurs WHERE nom_utilisateur = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['type_utilisateur'];
    }

    return null; // Utilisateur non trouvé
}


//Fonction qui affiche les client
function GetAllClients()
{
    $conn = Connect();
    $sql = 'select id_client, nom_client, ville_client, telephone_client,email_client from clients join utilisateurs on utilisateurs.id_utilisateur = clients.id_utilisateur ';
    $result = mysqli_query($conn, $sql);

    if ($result){
        return $result;
    }
    else
    {
        return false;
    }
}
?>
