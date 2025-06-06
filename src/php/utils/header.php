<?php
function displayHeader($page) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tiramisu - <?php echo ucfirst(str_replace('.php', '', $page)); ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <header class="header-container">
            <div class="header-text">
                <h1>Tiramisu</h1>
                <p>Découvrez nos délicieux tiramisus artisanaux</p>
            </div>
        </header>

        <nav class="navbar">
            <ul>
                <li><a href="?page=accueil.php">Accueil</a></li>
                <li><a href="?page=tiramisu.php">Nos Tiramisus</a></li>
                <div class="navbar-right">
                    <li><a href="?page=inscription.php">Inscription</a></li>
                    <li><a href="?page=login.php">Connexion Utilisateur</a></li>
                    <li><a href="admin/index_.php?page=login.php">Connexion Admin</a></li>
                </div>
            </ul>
        </nav>

        <div class="container mt-4">
    <?php
}
?> 