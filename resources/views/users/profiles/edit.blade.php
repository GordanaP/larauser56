@extends('layouts.app')

@section('title', '| My Profile')

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
                <i class="fa fa-user"></i> My profile
            </h4>
        </div>

        <div class="card-body">
            @include('users.profiles.forms._edit')
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var profileForm = $('#userProfileForm')

        profileForm.formValidation({
            @include('validators.general._framework'),
            fields: {
                @include('validators.profiles._fields')
            }
        })
        .on('keyup', '[name="name"], [name="about"], [name="location"]', function(e) {

                @include('validators.profiles._onkeyup')
        });
    </script>
@endsection