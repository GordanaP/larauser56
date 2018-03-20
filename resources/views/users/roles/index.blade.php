@extends('layouts.admin')

@section('title', '| Admin | Roles')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')

    <div class="pb-2 mb-3 col-md-12">
        <h1 class="h2 flex align-center justify-between">
            <span>Roles</span>
            <button class="btn btn-warning" id="createRole">New role</button>
        </h1>

        <hr>

        <div id="displayRoles">
            @if ($roles->count())
                @foreach ($roles->chunk(3) as $chunk)
                    <div class="row mb-2" id="roleCard">
                        @each('users.roles.partials._card', $chunk, 'role')
                    </div>
                @endforeach
            @else
                No roles were found.
            @endif
        </div>
    </div>


    <!-- Role Modal -->
    @include('users.roles.partials._modal')

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var roleModal = $("#roleModal")
        var roleForm = $("#roleForm")
        var rolesIndexUrl = "{{ route('admin.roles.index') }}"
        var roleFields = ['name']

        roleModal.setAutofocus('name')
        roleModal.emptyModal(roleFields, roleForm)

        // Create role
        @include('users.roles.js._create')

        // Edit role
        @include('users.roles.js._edit')

        // Store & update with client side validation
        @include('users.roles.js._JSvalidation')

        // Delete role
        @include('users.roles.js._delete')

    </script>
@endsection