<?php
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo "ID manquant.";
    exit;
}

$id = intval($_GET['id']);

$textes = [
    1 => "Des tiramisus artisanaux préparés avec les meilleurs ingrédients.",
    2 => "Des ingrédients frais et de qualité pour un goût exceptionnel.",
    3 => "Parfaits pour partager de bons moments entre amis ou en famille."
];

if (array_key_exists($id, $textes)) {
    echo $textes[$id];
} else {
    echo "Contenu non disponible.";
}
?>
