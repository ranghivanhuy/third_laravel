function fileSelect(evt) {
    var files = evt.target.files;
    var file;
    for (var i = 0; file = files[i]; i++) {
        if (!file.type.match('image.*')) {
            continue;
        }
        reader = new FileReader(    );
        reader.onload = (function () {
            return function (evt) {
                var img = document.createElement('div');
                img.className = 'showImage';
                img.id = 'showImage';
                img.innerHTML = '<img style="width: 150px; height: 150px; float: left; padding: 15px" src="' + evt.target.result + '"/>';
                document.getElementById('filesInfo').appendChild(img);
            };
        }(file));
        reader.readAsDataURL(file);
    }
}
document.getElementById('image').addEventListener('change', fileSelect, false);

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#photoPreview').attr('src', (e.target.result));
            $('#photoPreview').hide();
            $('#photoPreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#photo").change(function () {
    readURL(this);
});