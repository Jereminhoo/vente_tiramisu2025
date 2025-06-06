<?php
require('src/php/utils/check_connection.php');

// 📁 Lire les images disponibles dans assets/images/
$dir = './assets/images/';
$images = [];
if (is_dir($dir)) {
    foreach (scandir($dir) as $file) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $images[] = $file;
        }
    }
}

// 🎯 Traitement de l'ajout
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
    <h2 class="text-center mb-4">Ajouter un tiramisu</h2>

    <?php if (isset($message_success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message_success) ?></div>
    <?php endif; ?>

    <?php if (isset($message_erreur)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message_erreur) ?></div>
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
                            <label for="photo" class="form-label">Sélectionner une image</label>
                            <select class="form-select" name="photo" id="photo" required>
                                <option value="">-- Choisir une image --</option>
                                <?php foreach ($images as $img): ?>
                                    <option value="<?= htmlspecialchars($img) ?>"><?= htmlspecialchars($img) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- 🖼️ Aperçu image sélectionnée -->
                        <div id="preview-container" class="mt-3 text-center">
                            <img id="preview-image" src="" alt="Aperçu" style="max-width: 100%; display: none;">
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" name="ajouter_tiramisu" class="btn btn-primary">Ajouter le tiramisu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./assets/js/photo_preview.js"></script>
