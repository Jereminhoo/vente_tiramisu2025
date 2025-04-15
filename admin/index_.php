<?php
session_start();
//INDEX ADMIN
include('./src/php/utils/header.php');
include('./src/php/utils/all_includes.php');

// Débogage
if (!isset($_SESSION['page'])) {
    $_SESSION['page'] = 'accueil.php';
}
?>

<!doctype html>
<html>
<head>
    <title><?php print $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
<div id="page" class="container">
    <header class="img_header"></header>
    <section id=" ">
        <nav>
            <?php if(file_exists('src/php/utils/admin_menu.php')){
                include('src/php/utils/admin_menu.php');
            }
            ?>
        </nav>
    </section>
    <section id="contenu">
        <div class="container">
            <?php
            // Débogage
            echo "<div class='alert alert-info'>Page demandée : " . $_SESSION['page'] . "</div>";
            
            $page_path = '../content/' . $_SESSION['page'];
            echo "<div class='alert alert-info'>Chemin complet : " . $page_path . "</div>";
            
            if (file_exists($page_path)) {
                include($page_path);
            } else {
                echo "<div class='alert alert-danger'>Page non trouvée : " . $_SESSION['page'] . "</div>";
                echo "<div class='alert alert-danger'>Chemin non trouvé : " . $page_path . "</div>";
            }
            ?>
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