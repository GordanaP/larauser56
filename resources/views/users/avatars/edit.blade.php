@extends('layouts.app')

@section('title', '| Save Avatar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
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
@endsection