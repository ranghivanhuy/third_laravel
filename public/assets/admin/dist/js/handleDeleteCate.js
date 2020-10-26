$(document).ready(function(){
    var url = $('#url').val();
    $('.open-delete').click(function(){
        var id = $(this).attr('data-id');
        $(document).on('click','#btn-delete',function(){
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            $.ajax({
                type: "DELETE",
                url: url + '/destroy/' + id,
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('#btn-delete').val("delete");
        $('#frmPosts').trigger("reset");
        $('#myModal').modal('show');
    });
})