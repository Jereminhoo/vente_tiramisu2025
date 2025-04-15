<?php
$tiramisuDAO = new TiramisuDAO($cnx);
$liste = $tiramisuDAO->getTiramisus();

if ($liste === null) {
    die("Erreur : la requête SQL n'a retourné aucune donnée.");
}

if (empty($liste)) {
    die("La requête a bien fonctionné, mais la table `tiramisus` est vide.");
}

echo '<div class="tiramisu-container">';
foreach ($liste as $p) {
    echo '<div class="tiramisu-card">';
    
    echo '<h4>' . htmlspecialchars($p->nom_tiramisu) . '</h4>';
    
    echo '<img src="admin/assets/images/' . htmlspecialchars($p->photo) . '" 
          alt="Tiramisu ' . htmlspecialchars($p->nom_tiramisu) . '" 
          class="img-fluid">';
    
    echo '<p>' . htmlspecialchars($p->description) . '</p>';
    echo '<p class="price">Prix : ' . $p->prix . ' €</p>';
    
    echo '</div>';
}
echo '</div>';




