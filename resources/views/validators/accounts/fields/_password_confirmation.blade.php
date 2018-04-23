password_confirmation: {
    validators: {
        notEmpty: {
            message: 'The value is required.'
        },
        identical: {
            field: 'password',
            message: 'This value must match the password.'
        }
    }
}