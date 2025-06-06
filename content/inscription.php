<?php
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];
    
    $utilisateurDAO = new UtilisateurDAO($cnx);
    
    // Vérifier si l'utilisateur existe déjà
    $utilisateur = $utilisateurDAO->getUtilisateur($nom, $mdp);
    
    if ($utilisateur) {
        // L'utilisateur existe, on le connecte
        $_SESSION["admin"] = false;
        $_SESSION["user_nom"] = $utilisateur;
        header('Location: index_.php?page=accueil.php');
        exit;
    } else {
        // L'utilisateur n'existe pas, on l'inscrit
        $resultat = $utilisateurDAO->ajoutUtilisateur($nom, $mdp);
        
        if ($resultat == "Utilisateur ajouté avec succès") {
            $_SESSION["admin"] = false;
            $_SESSION["user_nom"] = $nom;
            header('Location: index_.php?page=accueil.php');
            exit;
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de l'inscription : " . $resultat . "</div>";
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Inscription / Connexion</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="mdp" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary">S'inscrire / Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 