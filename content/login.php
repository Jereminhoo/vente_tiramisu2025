<?php
//Traitements toujours au dessus

if(isset($_POST['login_submit']))
{
    extract($_POST, EXTR_OVERWRITE);
    
    // Vérification si c'est un admin
    $adm = new AdminDAO($cnx);
    $admin = $adm->getAdmin($login, $password);
    
    if ($admin != "ERREUR DE CONNEXION") {
        $_SESSION["admin"] = true;
        $_SESSION["user_nom"] = $admin;
        header('Location: admin/index_.php?page=accueil_admin.php');
    } else {
        // Vérification si c'est un utilisateur normal
        $user = new UtilisateurDAO($cnx);
        $nom = $user->getUtilisateur($login, $password);
        
        if ($nom) {
            $_SESSION["admin"] = false;
            $_SESSION["user_nom"] = $nom;
            header('Location: index_.php?page=accueil.php');
        } else {
            echo "<div class='alert alert-danger'>Identifiants incorrects</div>";
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Connexion</h3>
                </div>
                <div class="card-body">
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="mb-3">
                            <label for="login" class="form-label">Nom:</label>
                            <input type="text" class="form-control" id="login" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe: </label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="login_submit">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>