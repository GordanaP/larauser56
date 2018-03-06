editPermissionForm.formValidation({
    framework: 'bootstrap4',
    excluded: ':disabled',
    icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    fields: {
        resource: {
            validators: {
                notEmpty: {
                    message: 'The resource is required.'
                },
            }
        },
        permission: {
            validators: {
                notEmpty: {
                    message: 'The permission is required.'
                },
            }
        },
    }
})
.on('success.form.fv', function(e) {

    // form button must be type="submit"!!!
    e.preventDefault();

    var data = {
        resource : $('#resource').val(),
        permission: $(".permission:checked").val()
    }

    // Update permission
    @include('permissions.js._update')
});