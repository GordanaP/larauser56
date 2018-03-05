$(document).on('click', '#createPermission', function() {

    permissionModal.modal('show')

    $('.modal-title i').addClass('fa-thumbs-up')
    $('.modal-title span').text('New permission')
    $('.btn-permission').attr('id', 'storePermission').text('Save')
})