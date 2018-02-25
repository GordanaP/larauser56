@extends('layouts.app')

@section('title', '| My account')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h4>
                <i class="fa fa-lock fa-panel mr-6"></i> Edit account
            </h4>
        </div>
        <div class="card-body">
            @include('users.accounts.partials._formEdit')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        $('.account-form').formValidation({
            framework: 'bootstrap4',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
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
                        different: {
                            field: 'name',
                            message: 'The password must not be the same as the name.'
                        },
                        stringLength: {
                            min: 6,
                            message: 'The password must be at least 6 characters long.'
                        }
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
        .on('err.field.fv', function(e, data) {

            var invalidFields = data.fv.getInvalidFields()

            removeServerSideFeedback(invalidFields)
        })
        .on('success.field.fv', function(e, data) {

            var validFields = data.element

            removeServerSideFeedback(validFields)

        });

    </script>

@endsection