$(document).ready(function($) {
    $('.update_company').click(function() {
        var formData = {
            name: $('#name').val(),
            CEO: $('#ceo').val(),
            description: $('#description').val(),
            employee: $('#employee').val(),
            phone: $('#phone').val(),
            email: $('#email').val(),
            tax_code: $('#tax_code').val(),
            address: $('#address').val(),
            establish_date: $('establish'),
        };
        $.ajax({
            type: "put",
            url: "admin/about",
            data: formData,
            headers: {
                "X-CSRFToken": csrftoken
                    // "Content-Type": "application/json",
            },
            success: function(response) {}
        });
    });
});