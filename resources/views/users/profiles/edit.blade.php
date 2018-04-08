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
            @include('users.profiles.forms._update')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var profileForm = $('#userProfileForm')

        profileForm.formValidation({
            framework: 'bootstrap4',
            excluded: ':disabled', // form in BS modal
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Please provide at least one field value'
                            },
                            regexp: {
                                regexp: /^[A-za-z0-9 ]+$/i,
                                message: 'Only alphabetical characters, numbers, and spaces are allowed'
                            },
                            stringLength: {
                                max: 30,
                                message: 'The name must be less than 30 characters long'
                            }
                        }
                    },
                    about: {
                        validators: {
                            notEmpty: {
                                message: 'Please provide at least one field value'
                            },
                            stringLength: {
                                max: 150,
                                message: 'The value must be less than 150 characters long'
                            }
                        }
                    },
                    location: {
                        validators: {
                            notEmpty: {
                                message: 'Please provide at least one field value'
                            },
                            stringLength: {
                                max: 50,
                                message: 'Please provide at least one field value'
                            }
                        }
                    }
                }
            })
            .on('keyup', '#name, #about, #location', function() {

                var name        = profileForm.find('#name').val(),
                    about       = profileForm.find('#about').val(),
                    location     = profileForm.find('#location').val(),
                    fv           = profileForm.data('formValidation');

                switch ($(this).attr('id')) {

                    case 'name':
                        fv.enableFieldValidators('about', name === '').revalidateField('about');
                        fv.enableFieldValidators('location', name === '').revalidateField('location');

                        if (name && fv.getOptions('name', null, 'enabled') === false) {
                            fv.enableFieldValidators('name', true).revalidateField('name');
                        }
                        else if (name === '' && (about !== '' && location !== '')) {
                            fv.enableFieldValidators('name', false).revalidateField('name');
                        }
                        else if ((name === '' && about == '' && location !== '') ) {
                            fv.enableFieldValidators('name', false).revalidateField('name');
                            fv.enableFieldValidators('about', false).revalidateField('about');
                        }
                        else if ((name === '' && location == '' && about !== '') ) {
                            fv.enableFieldValidators('name', false).revalidateField('name');
                            fv.enableFieldValidators('location', false).revalidateField('location');
                        }
                        break;

                    case 'about':
                        fv.enableFieldValidators('name', about === '').revalidateField('name');
                        fv.enableFieldValidators('location', about === '').revalidateField('location');

                        if (about && fv.getOptions('about', null, 'enabled') === false) {
                            fv.enableFieldValidators('about', true).revalidateField('about');
                        }
                        else if (about === '' && (name !== '' && location !== '')) {
                            fv.enableFieldValidators('about', false).revalidateField('about');
                        }
                        else if ((about === '' && name == '' && location !== '') ) {
                            fv.enableFieldValidators('about', false).revalidateField('about');
                            fv.enableFieldValidators('name', false).revalidateField('name');
                        }
                        else if ((about === '' && location == '' && name !== '') ) {
                            fv.enableFieldValidators('about', false).revalidateField('about');
                            fv.enableFieldValidators('location', false).revalidateField('location');
                        }
                        break;

                    case 'location':
                        fv.enableFieldValidators('name', location === '').revalidateField('name');
                        fv.enableFieldValidators('about', location === '').revalidateField('about');

                        if (location && fv.getOptions('location', null, 'enabled') === false) {
                            fv.enableFieldValidators('location', true).revalidateField('location');
                        }
                        else if (location === '' && (name !== '' && about !== '')) {
                            fv.enableFieldValidators('location', false).revalidateField('location');
                        }
                        else if ((location === '' && name == '' && about !== '') ) {
                            fv.enableFieldValidators('location', false).revalidateField('location');
                            fv.enableFieldValidators('name', false).revalidateField('name');
                        }
                        else if ((location === '' && about == '' && name !== '') ) {
                            fv.enableFieldValidators('location', false).revalidateField('location');
                            fv.enableFieldValidators('about', false).revalidateField('about');
                        }
                        break;
                }
            })

    </script>
@endsection