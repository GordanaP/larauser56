@extends('layouts.app')

@section('content')

@endsection

@section('scripts')
            $(document).on('click', '#editPermission', function() {

            permissionModal.modal('show')

            var permission = $(this).val()
            var apiPermissionsShowUrl = apiPermissionsIndexUrl + '/' + permission

            $('.modal-title i').addClass('fa-pencil')
            $('.modal-title span').text('Edit permission')
            $('.btn-permission').attr('id', 'updatePermission').text('Save changes').val(permission)

            $.ajax({
                url: apiPermissionsShowUrl,
                type: "GET",
                success: function(response) {
                    console.log(response.data.permission)
                }
            })
        })

@endsection