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

        $(document).on("click", '#createRole', function(){

            roleModal.modal('show')

            $('.modal-title i').addClass('fa-briefcase')
            $('.modal-title span').text('New role')
            $('.btn-role').text('Save').attr('id', 'storeRole');
        })

        $(document).on('click', '#storeRole', function(){

            var data = {
                name : $('#name').val()
            }

            $.ajax({
                url: rolesIndexUrl,
                method: "POST",
                data: data,
                success: function(response)
                {
                    $('#displayRoles').load(location.href + " #displayRoles")
                    successResponse(roleModal, response.message)
                },
            })
        })

        $(document).on("click", '#editRole', function() {

            roleModal.modal('show')

            var role = $(this).val()
            var rolesShowUrl = rolesIndexUrl + '/' + role

            $('.modal-title i').addClass('fa-briefcase')
            $('.modal-title span').text('Edit role')
            $('.btn-role').text('Save changes').attr('id', 'updateRole').val(role);

            $.ajax({
                url : rolesShowUrl,
                type: "GET",
                success: function(response) {

                    $('#name').val(response.role.name)
                }
            })


        })

        $(document).on('click', '#updateRole', function() {

            var role = $(this).val()
            var rolesUpdateUrl = rolesIndexUrl + '/' + role

            var data = {
                name : $('#name').val()
            }

            $.ajax({
                url : rolesUpdateUrl,
                type: "PUT",
                data: data,
                success: function(response) {

                    $('#displayRoles').load(location.href + " #displayRoles")
                    successResponse(roleModal, response.message)
                }
            })
        });

        $(document).on('click', '#deleteRole', function(){

            var role = $(this).val();
            var rolesDeleteUrl = rolesIndexUrl + '/' + role
            name = 'role'
            var field = '#displayRoles'

            swalDelete(rolesDeleteUrl, name, datatable=null, field)

        })

    </script>
@endsection