accountForm.formValidation({
    framework: 'bootstrap4',
    excluded: ':disabled', // form in BS modal
    icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: "The name is required"
                },
                regexp: {
                    regexp: /^[A-za-z0-9]+$/i,
                    message: 'Only alphabetical characters and numbers are allowed.'
                },
                stringLength: {
                    max: 30,
                    message: 'The name must be less than 30 characters long.'
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'The email is required.'
                },
                emailAddress: {
                    message: 'The value is not a valid email address.'
                },
                stringLength: {
                    max: 100,
                    message: 'The email address must be less than 100 characters long.'
                }
            }
        },
        password: {
            validators: {
                stringLength: {
                    min: 6,
                    message: 'The password must be at least 6 characters long.'
                },
                different: {
                    field: 'name',
                    message: 'The password must not be the same as the name.'
                },
            }
        },
        password_confirmation: {
            validators: {
                identical: {
                    field: 'password',
                    message: 'This value must match the password.'
                }
            }
        },
    }
})
.on('success.form.fv', function(e) {

    // form button must be type="submit"!!!
    e.preventDefault();

    @include('admin.settings.js._update')
});