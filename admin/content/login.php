<?php
if (isset($_POST['login_submit'])) {
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];
    
    $adminDAO = new AdminDAO($cnx);
    $admin = $adminDAO->getAdmin($nom, $mdp);
    
    if ($admin) {
        $_SESSION["admin"] = true;
        $_SESSION["user_nom"] = $admin;
        header('Location: index_.php?page=accueil_admin.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Identifiants incorrects</div>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Connexion Admin</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom d'administrateur</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="mdp" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="login_submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 