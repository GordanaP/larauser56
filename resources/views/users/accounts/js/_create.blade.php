$(document).on('click', '#createAccount', function() {

    accountModal.modal('show')

    $('.modal-title i').addClass('fa-user')
    $('.modal-title span').text('New account')
    $('.btn-account').attr('id','storeAccount').text('Save')

    $('input:radio').change(function(){
        var checked = $("form input[type=radio]:checked").val();

        checked == 'manual' ? password.show() : password.hide()
    });
});