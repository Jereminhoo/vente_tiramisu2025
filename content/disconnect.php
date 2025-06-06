<?php
// Détruire la session
session_destroy();

// Rediriger vers la page d'accueil
header('Location: index_.php?page=accueil.php');
exit;
?> 