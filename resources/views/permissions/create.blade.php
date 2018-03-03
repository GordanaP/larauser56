@extends('layouts.admin')

@section('title', '| Admin | Permissions')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')
    <div class="pb-2 mb-3 col-md-12">
        <h1 class="h2 flex align-center justify-between">
            <span>Permissions</span>
            <button class="btn btn-info" id="createRole">
                <span data-feather="plus"></span> New permission
            </button>
        </h1>

        <hr>

        @include('errors._list')

        <div class="col-md-6" id="displayPermissions">
            <form action="{{ route('admin.permissions.store') }}" method="POST" id="permissionForm">

                <p class="required-fields mb-18">
                    <sup><i class="fa fa-asterisk fa-form"></i></sup> Required field.
                </p>

                @csrf

                <!-- Resources -->
                <div class="form_group mb-4">
                    <label for="resource">Resource   <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>
                    <select class="form-control" name="resource" id="resource">
                        <option value="">Select a resource</option>
                        @foreach (Resources::all() as $resource)
                            <option value="{{ $resource }}">
                                {{ $resource }}
                            </option>
                        @endforeach
                    </select>

                    <span class="invalid-feedback resource"></span>
                </div>

                <!-- CRUD methods -->
                <div class="form-group mb-4">
                    <label for="">Select a permission   <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                    @foreach (Cruds::all() as $key => $value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" id="{{ $key }}" value="{{ $key }}" multiple checked>
                            <label class="form-check-label" for="{{ $key }}">{{ strtoupper($value) }}</label>
                        </div>
                    @endforeach

                    <span class="invalid-feedback permission"></span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var permissionForm = $('#permissionForm')

        permissionForm.formValidation({
            framework: 'bootstrap4',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                resource: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required.'
                        },
                    }
                },
                'permission[]': {
                    validators: {
                        notEmpty: {
                            message: 'The name is required.'
                        },
                    }
                },
            }
        })

    </script>

@endsection