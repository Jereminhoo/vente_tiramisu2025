<?php
$tiramisuDAO = new TiramisuDAO($cnx);
$liste = $tiramisuDAO->getTiramisus();

if ($liste === null) {
    die("Erreur : la requête SQL n'a retourné aucune donnée.");
}

if (empty($liste)) {
    die("La requête a bien fonctionné, mais la table `tiramisus` est vide.");
}

foreach ($liste as $p) {
    echo "<div style='margin-bottom: 40px; border-bottom: 1px solid #ccc; padding-bottom: 20px;'>";

    echo "<h4>" . htmlspecialchars($p->nom_tiramisu) . "</h4>";

    echo "<img src=\"admin/assets/images/" . htmlspecialchars($p->photo) . "\" 
      alt=\"Tiramisu image\" style=\"max-width: 300px;\"><br>";



    echo "<p>" . htmlspecialchars($p->description) . "</p>";
    echo "<p><strong>Prix :</strong> " . $p->prix . " €</p>";

    echo "</div>";
}




