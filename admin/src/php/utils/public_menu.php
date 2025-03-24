<?php $page = $_SESSION['page'] ?? 'accueil.php'; ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'accueil.php') ? 'active' : '' ?>" href="index_.php?page=accueil.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'tiramisus.php') ? 'active' : '' ?>" href="index_.php?page=tiramisus.php">Tiramisus</a>
                </li>
            </ul>
            <div class="ms-auto p-2">
                <a href="index_.php?page=login.php">Connexion</a>
            </div>
        </div>
    </div>
</nav>
