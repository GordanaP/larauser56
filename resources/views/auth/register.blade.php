@extends('layouts.master')

@section('title', '| Register')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Register</div>

                <div class="card-body">
                    @include('auth.forms._register')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        $('.account-form').formValidation({
            framework: 'bootstrap4',

            @include('validators.accounts._fields')

        })

        @include('validators.accounts._removeSSfeedback')

    </script>

@endsection