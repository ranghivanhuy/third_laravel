$(document).ready(function() {
    $('.delete-image-primary').click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var id = $(this).attr('data-id');
        console.log(id);
        $.ajax({
            url: '/products/prodDelete/' + id,
            method: 'DELETE',
            data: '',
            success: function(data)
            {
                // location.reload();
            }
        });
        $(this).parent('#primary-image-to-upload').remove();
        $("#display-primary-image").val('');
    });
    $('#primary-image').on('change', function(e) {
        $('#primary-image-to-upload').html('');
        var files = e.target.files;
        $.each(files, function(i, file) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e) {
                var template = '<div class="uploadimage" id="img-0">';
                    template += '<img class="image-upload" src="' + e.target.result + '">';
                    template += '<input name="photo" id="file-input" type="hidden" value="' + e.target.result + '">';
                    template += '<button type="button" class="upload-image-primary">X</button>';
                    template += '</div>';
                    $('#primary-image-to-upload').append(template);
                    $('.upload-image-primary').click(function () {
                        $(this).parent('.uploadimage').remove();
                        $("#primary-image").val('');
                    });
            }
        });
    });

    $('.delete-image-multiple').click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        var id = $(this).attr('data-id');
        $.ajax({
            url: '/products/delete/' + id,
            method: 'DELETE',
            data: '',
            success: function(data)
            {
                location.reload();
            }
        });
    });
    $('#multiple-image').on('change', function(e) {
        var files = e.target.files;
        $.each(files, function(i, files) {
            var reader = new FileReader();
            reader.readAsDataURL(files);
            reader.onload = function(e) {
                var templateMuliple = '<div class="uploadimage" id="img-0">';
                    templateMuliple += '<img class="image-upload" src="' + e.target.result + '">';
                    templateMuliple += '<input name="image[]" type="hidden" value="' + e.target.result + '">';
                    templateMuliple += '<button type="button" class="upload-image-primary">X</button>';
                    templateMuliple += '</div>';
                    $('#multiple-image-to-upload').append(templateMuliple);
                    $('.upload-image-primary').click(function () {
                        $(this).parent('.uploadimage').remove();
                        $("#multiple-image").val('');
                    });
            }
        });
    });
});