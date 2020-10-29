$(document).ready(function () {
    $('#btn-edit-product').click(function () {
        var id = $(this).data('id');
        console.log(id);
        var product_id = $(this).attr('data-id');
        console.log(product_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var formData = {
            name: $('#name').val(),
            price: $('#price').val(),
            photo: $('#description').val()
        }
        $.ajax({
            url: '/products/edit/' + id,
            method: 'PUT',
            data: formData,
            success: function(data) 
            {
                
            }
        });
    });
});