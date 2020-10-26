function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#avatarPreview').attr('src', (e.target.result));
            $('#avatarPreview').hide();
            $('#avatarPreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#avatar").change(function () {
    readURL(this);
});