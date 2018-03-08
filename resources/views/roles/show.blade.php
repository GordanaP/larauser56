@extends('layouts.admin')

@section('title', '| Admin | Roles')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')

    <div class="pb-2 mb-3 col-md-12">
        <h1 class="h2 flex align-center justify-between">
            <span>{{ ucfirst($role->name) }}</span>
            <a class="btn btn-info" href="{{ route('admin.roles.index') }}">
                <span data-feather="briefcase"></span> All roles
            </a>
        </h1>

        <hr>

        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>

        <div class="card mb-4 box-shadow bg-lightest-gray">
            <div class="card-body">
                <h5 class="mb-18"><b>Check the permissions to grant to {{ $role->name }} role</b></h5>

                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">

                    @csrf
                    @method("PUT")

                    @foreach ($permissions as $permission)
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $permission }}" id="{{ $permission }}">
                                <label class="form-check-label" for="{{ $permission }}">
                                    {{ $permission }}
                                </label>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>


    </script>

@endsection