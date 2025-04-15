<?php
// Détruire toutes les variables de session
$_SESSION = array();

// Détruire le cookie de session
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Détruire la session
session_destroy();

// Rediriger vers la page d'accueil
header("Location: index_.php?page=accueil.php");
exit;

//<meta http-equiv="refresh", content="0;url=../index_.php?page=accueil.php">
?>