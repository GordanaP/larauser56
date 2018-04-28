@extends('layouts.app')

@section('title', '| My Avatar')

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
                <i class="fa fa-user-circle"></i> My avatar
            </h4>
        </div>

        <div class="card-body">
            @include('users.avatars.forms._edit')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var avatarForm = $('#userAvatarForm')

        avatarForm.formValidation({
            @include('validators.general._framework'),
            fields: {
                @include('validators.avatars._fields'),
            }
        })
        .on('change', '[name="avatar_options"], [name="avatar"]', function() {

                @include('validators.avatars._onchange')
        })

    </script>
@endsection

