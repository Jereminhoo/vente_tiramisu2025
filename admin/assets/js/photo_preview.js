$(document).ready(function () {
    $('#photo').on('change', function () {
        const file = $(this).val();
        const preview = $('#preview-image');

        if (file) {
            preview.attr('src', './assets/images/' + file).show();
        } else {
            preview.hide();
        }
    });
});
