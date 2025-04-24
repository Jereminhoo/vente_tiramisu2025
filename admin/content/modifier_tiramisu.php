<?php
require('src/php/utils/check_connection.php');

$tiramisuDAO = new TiramisuDAO($cnx);

// Traitement de la modification
if (isset($_POST['modifier_tiramisu'])) {
    $id = $_POST['id_tiramisu'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $photo = $_POST['photo'];

    $resultat = $tiramisuDAO->modifierTiramisu($id, $nom, $description, $prix, $photo);

    if ($resultat === "Tiramisu modifié") {
        $message_success = "Le tiramisu a été modifié avec succès.";
    } else {
        $message_erreur = $resultat;
    }
}

// Récupération du tiramisu sélectionné
$tiramisu_edition = null;
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] !== '') {
    $tiramisu_edition = $tiramisuDAO->getTiramisuById($_GET['id']);
}

// Récupération de tous les tiramisus pour le menu déroulant
$tiramisus = $tiramisuDAO->getAllTiramisus();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier un tiramisu</h2>

    <?php if (isset($message_success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message_success) ?></div>
    <?php endif; ?>

    <?php if (isset($message_erreur)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message_erreur) ?></div>
    <?php endif; ?>

    <!-- Sélecteur de tiramisu -->
    <form method="get" class="mb-4">
        <label for="id" class="form-label">Sélectionnez un tiramisu à modifier :</label>
        <select name="id" id="id" class="form-select" onchange="this.form.submit()">
            <option value="">-- Choisir --</option>
            <?php foreach ($tiramisus as $t): ?>
                <option value="<?= $t->id_tiramisu ?>" <?= (isset($tiramisu_edition) && $tiramisu_edition->id_tiramisu == $t->id_tiramisu) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($t->nom_tiramisu) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- Formulaire de modification -->
    <?php if ($tiramisu_edition): ?>
        <form method="post" action="">
            <input type="hidden" name="id_tiramisu" value="<?= $tiramisu_edition->id_tiramisu ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du tiramisu</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($tiramisu_edition->nom_tiramisu) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($tiramisu_edition->description) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($tiramisu_edition->prix) ?>" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">URL de la photo</label>
                <input type="text" class="form-control" id="photo" name="photo" value="<?= htmlspecialchars($tiramisu_edition->photo) ?>" required>
            </div>
            <div class="d-grid">
                <button type="submit" name="modifier_tiramisu" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </form>
    <?php endif; ?>
</div>
