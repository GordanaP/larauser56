createAccountForm
.@include('validators.general._select2')
.formValidation({
    @include('validators.general._framework'),
    excluded: ':disabled',
    fields: {
        @include('validators.accounts.fields._role_id'),
        @include('validators.accounts.fields._name'),
        @include('validators.accounts.fields._email'),
        @include('validators.accounts.fields._password_store'),
        @include('validators.accounts.fields._password_confirmation'),
    }
})
.on('change', '[name="create-password"]', function(e) {

    createAccountForm.formValidation('revalidateField', 'password');
})
.on('success.form.fv', function(e, data) {

    // form button must be type="submit"!!!
    e.preventDefault();

    @include('users.accounts.js._store')
});