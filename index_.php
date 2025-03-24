<?php
session_start();
include('./admin/src/php/utils/header.php');
include('./admin/src/php/utils/all_includes.php');

$allowed_pages = ['accueil.php', 'tiramisus.php', 'jquery_ui1.php', 'login.php'];
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
<div id="page" class="container">
    <header class="img_header"></header>
    <nav>
        <?php if (file_exists('admin/src/php/utils/public_menu.php')) {
            include('admin/src/php/utils/public_menu.php');
        } ?>
    </nav>
    <section id="contenu">
        <div class="container">
            <?php include("./content/$page"); ?>
        </div>
    </section>
</div>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">Mission 2025</span>
    </div>
</footer>
</body>
</html>
