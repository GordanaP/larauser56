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

        $('.account-form').formValidation({
            framework: 'bootstrap4',

            @include('validators.accounts._fields')
        })

        @include('validators.accounts._removeSSfeedback')

    </script>

@endsection