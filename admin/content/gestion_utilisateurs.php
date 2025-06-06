<?php
require('src/php/utils/check_connection.php');

// Traitement de la suppression d'un utilisateur
if (isset($_POST['supprimer_utilisateur'])) {
    $nom = $_POST['nom_utilisateur'];
    $utilisateurDAO = new UtilisateurDAO($cnx);
    $resultat = $utilisateurDAO->supprimerUtilisateur($nom);
    if ($resultat == "Utilisateur supprimé") {
        $message_success = "L'utilisateur a été supprimé avec succès";
    } else {
        $message_erreur = $resultat;
    }
}

// Récupération de tous les utilisateurs
$utilisateurDAO = new UtilisateurDAO($cnx);
$utilisateurs = $utilisateurDAO->getAllUtilisateurs();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gestion des utilisateurs</h2>

    <?php if (isset($message_success)): ?>
        <div class="alert alert-success"><?php echo $message_success; ?></div>
    <?php endif; ?>

    <?php if (isset($message_erreur)): ?>
        <div class="alert alert-danger"><?php echo $message_erreur; ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($utilisateur['nom']); ?></td>
                    <td>
                        <form method="post" action="" style="display: inline;">
                            <input type="hidden" name="nom_utilisateur" value="<?php echo htmlspecialchars($utilisateur['nom']); ?>">
                            <button type="submit" name="supprimer_utilisateur" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
