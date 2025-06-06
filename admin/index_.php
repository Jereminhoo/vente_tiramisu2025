<?php
session_start();
//INDEX ADMIN
include('./src/php/utils/header.php');
include('./src/php/utils/all_includes.php');

$page = $_SESSION['page'] ?? 'accueil_admin.php';
?>

<!doctype html>
<html>
<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>

<body>
<div class="header-container">
    <div class="header-text">
        <h1>Tiramisu</h1>
        <p>Découvrez nos délicieux tiramisus artisanaux</p>
    </div>
</div>

<div id="page">
    <nav class="navbar">
        <ul>
            <li><a href="?page=gestion_utilisateurs.php">Gestion des utilisateurs</a></li>
            <li><a href="?page=ajout_tiramisu.php">Ajouter un tiramisu</a></li>
            <li><a href="?page=suppression_tiramisu.php">Supprimer un tiramisu</a></li>
            <li><a href="?page=modifier_tiramisu.php">Modifier un tiramisu</a></li>
            <div class="navbar-right">
                <?php if (isset($_SESSION['user_nom'])): ?>
                    <li><a href="?page=disconnect.php">Déconnexion</a></li>
                <?php endif; ?>
            </div>
        </ul>
    </nav>
    <section id="contenu">
        <div class="container">
            <?php include("./content/$page"); ?>
        </div>
    </section>
</div>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">Jeremy Muanza</span>
    </div>
</footer>
</body>
</html>