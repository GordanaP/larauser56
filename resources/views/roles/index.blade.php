@extends('layouts.admin')

@section('title', '| Admin | Roles')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')
    <div class="pb-2 mb-3 col-md-12">
        <h1 class="h2 flex align-center justify-between">
            <span>Roles</span>
            <button class="btn btn-warning" id="createRole"><span data-feather="plus"></span> New role</button>
        </h1>

        <hr>

        <div id="displayRoles">
            @if ($roles->count())
                @foreach ($roles->chunk(3) as $chunk)
                    <div class="row mb-2">
                        @each('roles.partials._card', $chunk, 'role')
                    </div>
                @endforeach
            @else
                No roles were found.
            @endif
        </div>
    </div>

    <!-- Modal -->
    @include('roles.partials._modal')

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var roleModal = $('#roleModal')
        var roleForm = $("#roleForm")
        var adminRolesIndexUrl = "{{ route('admin.roles.index') }}"
        var roleFields = ['name']

        setModalAutofocus(roleModal, 'name')
        emptyModalOnClose(roleFields, roleForm)

        // Create role
        @include('roles.js._create')

        // Edit role
        @include('roles.js._edit')

        // Validate, store & update role
        @include('roles.js._validate')

        // Delete role
        $(document).on('click', '#deleteRole', function(){

            var role = $(this).val()
            var adminRolesDeleteUrl = adminRolesIndexUrl + '/' + role

            swal({
                title: 'Are you sure?',
                text: 'You will not be able to recover the role',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if(result.value == true)
                {
                    $.ajax({
                        url : adminRolesDeleteUrl,
                        type : "DELETE",
                        success : function(response) {
                            $('#displayRoles').load(location.href + " #displayRoles")
                            userNotification(response.message)
                        },
                    })
                }
            })
        })

    </script>

@endsection