accountForm.formValidation({
    framework: 'bootstrap4',
    excluded: ':disabled', // form in BS modal
    @include('validators.accounts._fields')
})
.on('success.form.fv', function(e) {

    // form button must be type="submit"!!!
    e.preventDefault();

    var password = randomString(6)

    var data = {
        name : $("#name").val(),
        email : $("#email").val(),
        password: password,
        password_confirmation: password,
    }

    // Store account
    if($(".btn-account").attr('id') == 'storeAccount') {

        @include('users.accounts.js._store')
    }

    // Update account
    if($(".btn-account").attr('id') == 'updateAccount') {

        @include('users.accounts.js._update')
    }
});