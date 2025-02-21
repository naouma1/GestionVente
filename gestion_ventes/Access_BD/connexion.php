<?php

//chargement des params de connexion à partir du fichier .env
function Connect()
{
    $params = file(__DIR__ . "/.env");
    $server = trim(explode(":", $params[0])[1]);
    $user = trim(explode(":", $params[1])[1]);
    $password = trim(explode(":", $params[2])[1]);
    $db_name = trim(explode(":", $params[3])[1]);
    return mysqli_connect($server, $user, $password, $db_name);
}
?>

