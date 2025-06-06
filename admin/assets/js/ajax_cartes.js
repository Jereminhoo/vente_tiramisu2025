document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".carte").forEach(carte => {
        const titre = carte.querySelector("h3");
        const contenu = carte.querySelector(".contenu-carte");
        const id = carte.getAttribute("data-id");

        // On prépare une variable pour mémoriser le texte récupéré
        let texteCharge = null;

        titre.addEventListener("mouseover", () => {
            if (texteCharge !== null) {
                contenu.innerText = texteCharge;
                return;
            }

            // AJAX (chargé une seule fois)
            fetch("/TI2/vente_tiramisu/admin/src/php/ajax/get_card_text.php?id=" + id)
                .then(response => response.text())
                .then(data => {
                    texteCharge = data;
                    contenu.innerText = data;
                })
                .catch(error => {
                    contenu.innerText = "Erreur de chargement.";
                    console.error(error);
                });
        });

        titre.addEventListener("mouseout", () => {
            contenu.innerText = "";
        });
    });
});
