@extends('layouts.app')

@section('title', '| Test')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')

    @php
        $user = \App\User::find(2);
    @endphp

    <button class="btn btn-default" id="editRoles" value="{{ $user->slug }}">
        Revoke roles
    </button>

    <div class="modal" tabindex="-1" role="dialog" id="revokeRolesModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="revokeRolesForm">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-user"></i>
                            <span></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="required-fields mb-18">
                            <sup><i class="fa fa-asterisk fa-form"></i></sup> Required field
                        </p>

                        <!-- Roles -->
                        <div class="form-group">

                            <label for="role_id">Revoke role(s) <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                            <div id="role">

                                @include('users.roles.partials._html', [
                                    'user' => $user
                                ])
                            </div>

                            <span class="invalid-feedback role_id"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="revokeRoles">Revoke</button>
                    </div>
                </form>

            </div><!-- /. modal-content -->
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        $(document).on('click', '#editRoles', function(){

            $('#revokeRolesModal').modal('show')

            var user = $(this).val();
            var UserRolesUrl = '/users/accounts/' + user + '/edit'

            $.ajax({
                url: UserRolesUrl,
                type: "GET",
                success: function(response) {
                    // $('#role').html(response.html);
                }
            })
        })

        $('#revokeRolesForm').formValidation({
            framework: 'bootstrap4',
            excluded: ':disabled',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                'role_id[]': {
                    validators: {
                        notEmpty: {
                            message: 'The name is required.'
                        },
                    }
                },
            }
        })

    </script>
@endsection