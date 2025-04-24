document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("photo");
    const preview = document.getElementById("preview-image");

    select.addEventListener("change", function () {
        const file = select.value;
        if (file) {
            preview.src = "./assets/images/" + file;
            preview.style.display = "block";
        } else {
            preview.style.display = "none";
        }
    });
});
