$(document).ready(function(){
    var url = $('#url').val();
    $(document).on('click','.view-detail',function(){
        var id = $(this).data('id');
        console.log(id);
        if(url == 'http://127.0.0.1:8000/candidate/list-cv'){
            var my_url = 'http://127.0.0.1:8000/candidate';
        }else{
            var my_url = url;
        }
        var iframe_url =  'http://127.0.0.1:8000/uploads/user/filecv'
        // Điền dữ liệu trong Sửa Modal Form
        $.ajax({
            type: "GET",
            url: my_url + '/' + 'show/'+ id,
            success: function (data) {
                $('#view-cv').attr('src', iframe_url +'/'+ data.filecv +'#toolbar=1');
                $("#id-filecv").val(data.id);
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});