$(document).ready(function () {
    $('#kt_modal_add_user_form').on('submit', function (e) {
        
        e.preventDefault();
        $.ajax({
            url: 'admin/add/user',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#kt_modal_add_user_form').modal('hide');
                    Swal.fire({
                        text: "Form has been successfully submitted!",
                        icon: "success",
                        buttonsStyling: true,
                        confirmButtonText: "Ok, got it!",
                    })                }
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                console.log(response);
                if (errors.image) {
                    $('#avatar-error').text(errors.image[0]);
                }
                if (errors.name) {
                    $('#name-error').text(errors.name[0]);
                }
                if (errors.email) {
                    $('#email-error').text(errors.email[0]);
                }
            }
        });
    });
});
