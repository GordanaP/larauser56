@extends('layouts.app')

@section('title', '| Save Avatar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />

    <style>
        /*.form-control-feedback {display: block}*/
    </style>
@endsection

@section('side')
    @include('partials.side._auth')
@endsection

@section('content')

    <div class="card" class="user-panem">
        <div class="card-header">
            <h4>
                <i class="fa fa-user-circle"></i> My avatar
            </h4>
        </div>

        <div class="card-body">
            @include('users.avatars.forms._update')
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var avatarForm = $('#userAvatarForm')

        // Update avatar
        avatarForm.formValidation({
            framework: 'bootstrap4',
            excluded: ':disabled', // form in BS modal
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                avatar_options : {
                    validators : {
                        notEmpty: {
                            message: 'Please select an option'
                        },
                        between: {
                           min: 1,
                           max: 2,
                           message: 'The selected value is invalid'
                       }
                    }
                },
                avatar: {
                    enabled: false,
                    validators: {
                        notEmpty: {
                            message: 'Please select an image'
                        },
                        file: {
                            extension: 'jpeg,jpg,png, gif',
                            type: 'image/jpeg,image/png,image/gif',
                            maxSize: 2097152,   // 2048 * 1024
                            message: 'The selected file is not valid'
                        }
                    }
                }
            }
        })
        .on('change', '[name="avatar_options"], [name="avatar"]', function() {

            var options = avatarForm.find('[name="avatar_options"]').val(),
                avatar  = avatarForm.find('[name="avatar"]').val(),
                fv      = avatarForm.data('formValidation');

            // Enable avatar validator if avatar_options value = 1
            if(options == 1) {
                // $('.form-group-avatar').show()
                fv.enableFieldValidators('avatar', true).revalidateField('avatar');
            }
            // Disable avatar validator
            else {
                fv.enableFieldValidators('avatar', false).revalidateField('avatar');
                // $('.form-group-avatar').hide()
            }

        })

    </script>
@endsection

