@extends('layouts.app')

@section('title', '| Save Profile')

@section('side')
    @include('partials.side._auth')
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>
                <i class="fa fa-user"></i> My profile
            </h4>
        </div>

        <div class="card-body">
            @include('users.profiles.forms._update')
        </div>
    </div>

@endsection

@section('scripts')

@endsection