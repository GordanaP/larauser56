$(document).on('click', '#createAccount', function() {

    accountModal.modal('show')

    $('.modal-title i').addClass('fa-user')
    $('.modal-title span').text('New account')
    $('.btn-account').attr('id','storeAccount').text('Save')

    $(checked_field).change(function() {

        this.checked ? hidden_field.hide() : hidden_field.show()
    });
});