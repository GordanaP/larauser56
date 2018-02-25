$('.login-form').formValidation({
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
                notEmpty: {
                    message: 'The password is required.'
                },
            }
        },
    }
})

@include('validators.accounts._removeSSfeedback')