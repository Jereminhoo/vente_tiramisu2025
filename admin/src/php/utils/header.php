<?php
// Titre par défaut
$title = "TIRAMISU";

// Définition de la page à afficher
if (!isset($_SESSION['page'])) {
    $_SESSION['page'] = "accueil.php";
}

if (isset($_GET['page'])) {
    $_SESSION['page'] = $_GET['page'];
}

// Gestion des balises SEO par page
switch ($_SESSION['page']) {
    case "pdo_db.php":
        $title = "Exercices PDO | Site 2025";
        break;
    case "inscription.php":
        $title = "Inscription | Site 2025";
        break;
}

// Vérification si la page existe
if (!file_exists('content/' . $_SESSION['page'])) {
    $title = "Page introuvable | Site 2025";
    $_SESSION['page'] = 'page_404.php';
}

// Affichage du message de bienvenue et du bouton de déconnexion
if (isset($_SESSION['user_nom']) && $_SESSION['page'] != 'disconnect.php') {
    echo "<div class='alert alert-info text-center'>Bonjour " . htmlspecialchars($_SESSION['user_nom']) . " ! 
          </div>";
}
