<?php
//Traitements toujours au dessus

// Traitement de la connexion admin si le formulaire est soumis
if (isset($_POST['admin_submit'])) {
    $nom = $_POST['admin_nom'];
    $mdp = $_POST['admin_mdp'];
    
    $adminDAO = new AdminDAO($cnx);
    $admin = $adminDAO->getAdmin($nom, $mdp);
    
    if ($admin && $admin !== 'ERREUR DE CONNEXION') {
        $_SESSION["admin"] = true;
        $_SESSION["user_nom"] = $admin;
        header('Location: admin/index_.php?page=accueil_admin.php');
        exit;
    } else {
        $admin_error = "Identifiants admin incorrects";
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
                    <?php if (isset($admin_error)): ?>
                        <div class="alert alert-danger"><?php echo $admin_error; ?></div>
                    <?php endif; ?>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="admin_nom" class="form-label">Nom d'administrateur</label>
                            <input type="text" class="form-control" id="admin_nom" name="admin_nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="admin_mdp" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="admin_mdp" name="admin_mdp" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="admin_submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>