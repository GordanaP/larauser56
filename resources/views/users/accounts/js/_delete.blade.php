$(document).on('click', '#deleteAccount', function(){

    var user = $(this).val()
    var adminAccountsDeleteUrl = adminAccountsUrl + '/' + user

    swalDelete(adminAccountsDeleteUrl, 'account', datatable)

})