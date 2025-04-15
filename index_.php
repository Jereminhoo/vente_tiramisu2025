<?php
session_start();
include('./admin/src/php/utils/header.php');
include('./admin/src/php/utils/all_includes.php');

$allowed_pages = ['accueil.php', 'tiramisus.php', 'jquery_ui1.php', 'login.php', 'inscription.php', 'page_404.php', 'disconnect.php'];
$page = $_SESSION['page'] ?? 'accueil.php';

if (!in_array($page, $allowed_pages)) {
    $page = 'page_404.php';
}
?>

<!doctype html>
<html>
<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./admin/assets/js/fonctionsJqueryUI.js"></script>
    <link rel="stylesheet" type="text/css" href="./admin/assets/css/style.css">
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
            <li><a href="?page=accueil.php">Accueil</a></li>
            <li><a href="?page=tiramisus.php">Nos Tiramisus</a></li>
            <div class="navbar-right">
                <?php if (!isset($_SESSION['user_nom'])): ?>
                    <li><a href="?page=inscription.php">Inscription/ Connexion</a></li>
                <?php else: ?>
                    <li><a href="?page=disconnect.php">Déconnexion</a></li>
                <?php endif; ?>
                <li><a href="admin/index_.php?page=login.php">Connexion Admin</a></li>
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
