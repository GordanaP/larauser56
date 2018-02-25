$('.reset-password-form').formValidation({
    framework: 'bootstrap4',
    icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    fields: {
        email: {
            validators: {
                notEmpty: {
                    message: 'The email is required.'
                },
                emailAddress: {
                    message: 'The value is not a valid email address.'
                },
            }
        },
        password: {
            validators: {
                stringLength: {
                    min: 6,
                    message: 'The password must be at least 6 characters long.'
                }
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

@include('validators.accounts._removeSSfeedback')