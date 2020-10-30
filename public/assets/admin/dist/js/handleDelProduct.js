$(document).ready(function () {
    var url = $('#url').val();
    $('.open-delete-product').click(function () {
        var id = $(this).attr('data-id');
        $(document).on('click','#btn-delete-product',function(){
            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
               }
           });
           
           $.ajax({
               type: "DELETE",
               url:'/products/destroy/' + id,
               data: '',
               success: function (data) {
                   $('#product-' + id).remove();
                   $('.modal-backdrop').remove();
                   $('#myModal').remove();

               }
           });
       });
        $('#btn-delete-product').val("delete-product");
        $('#frmPosts').trigger("reset");
        $('#myModal').modal('show');
    });
});