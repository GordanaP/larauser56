createAccountForm
.find('select.role_id')
.select2({
    placeholder: "Select roles",
    width: "100%"
})
// Revalidate the color when it is changed
.change(function(e) {
    createAccountForm.formValidation('revalidateField', 'role_id[]');
})
.end()
.formValidation({
    framework: 'bootstrap4',
    excluded: ':disabled', // form in BS modal
    icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    fields: {
        'role_id[]': {
            validators: {
                callback: {
                    message: 'Please select roles',
                    callback: function(value, validator, $field) {
                        var options = validator.getFieldElements('role_id[]').val();
                        return (options != null && options.length >= 0);
                    }
                }
            }
        },
        name: {
            validators: {
                notEmpty: {
                    message: 'The name is required.'
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
                callback: {
                    message: 'Please give the password to the user',
                    callback: function(value, validator, $field) {

                        var checked = createAccountForm.find('[name="create-password"]:checked').val();

                        return (checked == 'auto') ? true : (value !== '');
                    }
                },
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
.on('change', '[name="create-password"]', function(e) {

    createAccountForm.formValidation('revalidateField', 'password');
})
.on('success.form.fv', function(e, data) {

    // form button must be type="submit"!!!
    e.preventDefault();

    var field = $("#auto_password");
    var password = generatePassword(field);

    var data = {
        role_id: $("#role_id").val(),
        name : $("#name").val(),
        email : $("#email").val(),
        password: password,
        password_confirmation: password,
    }

    $.ajax({
        url: adminAccountsUrl,
        type: "POST",
        data: data,
        success: function(response) {

            datatable.ajax.reload()
            successResponse(createAccountModal, response.message)
        },
        error: function(response) {
            errorResponse(response.responseJSON.errors, createAccountModal)
        }
    })
});
