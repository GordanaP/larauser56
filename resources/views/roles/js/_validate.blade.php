roleForm.formValidation({
    framework: 'bootstrap4',
    excluded: ':disabled',
    icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'The name is required.'
                },
                regexp: {
                    regexp: /^[A-za-z0-9 ]+$/i,
                    message: 'Only alphabetical characters, numbers and spaces are allowed.'
                },
                stringLength: {
                    max: 50,
                    message: 'The name must be less than 50 characters long.'
                }
            }
        },
    }
})
.on('success.form.fv', function(e) {

    // form button must be type="submit"!!!
    e.preventDefault();

    var data = {
        name: $('#name').val()
    }

    // Store role
    if($(".btn-role").attr('id') == 'storeRole') {

        @include('roles.js._store')
    }

    // Update role
    if($(".btn-role").attr('id') == 'updateRole') {

        var role = $('#updateRole').val()
        var adminRolesUpdateUrl = adminRolesIndexUrl + '/' + role

        $.ajax({
            url: adminRolesUpdateUrl,
            type: "PUT",
            data: data,
            success: function(response) {

                $('#displayRoles').load(location.href + " #displayRoles")
                roleModal.modal('hide')
                userNotification(response.message)
            },
            error: function(response) {

                errorResponse(response.responseJSON.errors, roleModal)

            }
        })
    }
});