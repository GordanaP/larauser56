createPermissionForm.formValidation({
    framework: 'bootstrap4',
    excluded: ':disabled',
    icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    fields: {
        model: {
            validators: {
                notEmpty: {
                    message: 'The resource model is required.'
                },
            }
        },
        'permission[]': {
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

    var permissions = $("input[name*='permission']:checked")
    var resource = $("select[name='model']").val()

    var storeData = {
        resource : resource,
        permission: checkboxValues(permissions)
    }

    //Store permission
    @include('permissions.js._store')
});