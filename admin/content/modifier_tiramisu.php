<?php
require('src/php/utils/check_connection.php');

// Traitement de l'ajout d'un tiramisu
if (isset($_POST['ajouter_tiramisu'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $photo = $_POST['photo'];

    $tiramisuDAO = new TiramisuDAO($cnx);
    $resultat = $tiramisuDAO->ajoutTiramisu($nom, $description, $prix, $photo);

    if ($resultat > 0) {
        $message_success = "Le tiramisu a été ajouté avec succès";
    } else {
        $message_erreur = "Erreur lors de l'ajout du tiramisu";
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier un tiramisu</h2>
    
    <?php if (isset($message_success)): ?>
        <div class="alert alert-success"><?php echo $message_success; ?></div>
    <?php endif; ?>
    
    <?php if (isset($message_erreur)): ?>
        <div class="alert alert-danger"><?php echo $message_erreur; ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du tiramisu</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">URL de la photo</label>
                            <input type="text" class="form-control" id="photo" name="photo" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="ajouter_tiramisu" class="btn btn-primary">Ajouter le tiramisu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 