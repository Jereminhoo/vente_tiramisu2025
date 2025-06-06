<?php
require('src/php/utils/check_connection.php');

// Traitement de la suppression d'un tiramisu
if (isset($_POST['supprimer_tiramisu'])) {
    $nom = $_POST['nom_tiramisu'];
    $tiramisuDAO = new TiramisuDAO($cnx);
    $resultat = $tiramisuDAO->supprimerTiramisu($nom);
    if ($resultat == "Tiramisu supprimé") {
        $message_success = "Le tiramisu a été supprimé avec succès";
    } else {
        $message_erreur = $resultat;
    }
}

// Récupération de tous les tiramisus
$tiramisuDAO = new TiramisuDAO($cnx);
$tiramisus = $tiramisuDAO->getAllTiramisus();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Supprimer un tiramisu</h2>

    <?php if (isset($message_success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message_success) ?></div>
    <?php endif; ?>

    <?php if (isset($message_erreur)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message_erreur) ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nom du tiramisu</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tiramisus as $tiramisu): ?>
                <tr>
                    <td><?= htmlspecialchars($tiramisu->nom_tiramisu) ?></td>
                    <td><?= htmlspecialchars($tiramisu->description) ?></td>
                    <td><?= htmlspecialchars($tiramisu->prix) ?> €</td>
                    <td>
                        <form method="post" action="" style="display: inline;">
                            <input type="hidden" name="nom_tiramisu" value="<?= htmlspecialchars($tiramisu->nom_tiramisu) ?>">
                            <button type="submit" name="supprimer_tiramisu" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tiramisu ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
