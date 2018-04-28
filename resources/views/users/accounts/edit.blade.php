@extends('layouts.app')

@section('title', '| My account')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('side')
    @include('partials.side._auth')
@endsection

@section('content')
    <div class="card user-panel">
        <div class="card-header">
            <h4>
                <i class="fa fa-lock fa-panel mr-6"></i> My account
            </h4>
        </div>
        <div class="card-body">
            @include('users.accounts.forms._edit')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        $('#userAccountForm').formValidation({
            @include('validators.general._framework'),
            fields: {
                @include('validators.accounts.fields._name'),
                @include('validators.accounts.fields._email'),
                @include('validators.accounts.fields._password'),
                @include('validators.accounts.fields._password_confirmation'),
            }
        })
        .on('err.field.fv', function(e, data) {

            var invalidFields = data.fv.getInvalidFields()
            removeServerSideValidationFeedback(invalidFields)
        })
        .on('success.field.fv', function(e, data) {

            var validFields = data.element
            removeServerSideValidationFeedback(validFields)
        })

    </script>
@endsection