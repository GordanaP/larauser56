@extends('layouts.admin')

@section('title', '| Admin | Settings')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')

    <div class="pb-2 col-md-12">
        <h2 class="admin-title-no-button">
            <span id="myProfileName">{{ optional($user->profile)->name ?: $user->name }}</span>
            <span class="muted"><small>admin</small></span>
        </h2>
        <hr>
    </div>

    <div class="row mt-24">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="pb-2 col-md-3 offset-md-1 text-center">
                    <div id="myAvatar">
                        <img src="{{ asset(setAvatar($user)) }}" alt="" class="image img-responsive rounded-circle"  height="220px">
                    </div>

                    <a href="#" id="editAvatar" data-user="{{ Auth::user()->slug }}">Change</a>
                </div>

                <div class="pb-2 col-md-7">
                    <div class="card mb-4 box-shadow bg-lightest-grey" id="adminSettings">
                        <div class="card-body">
                            <h5 class="card-title ls-1 text-uppercase text-bold-grey mb-15">
                                <i class="fa fa-lock"></i> <span class="mr-15">My account</span>
                                <button type="button" class="btn btn-warning btn-link" id="editMyAccount" value="{{Auth::user()->slug }}">
                                    Edit
                                </button>
                            </h5>

                            <div id="myAccount">
                                <p class="card-text mb-8 ml-20">
                                    <b>User name:</b> {{ Auth::user()->name }}
                                </p>
                                <p class="card-text ml-20">
                                    <b>Email:</b> {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title ls-1 text-uppercase text-bold-grey mb-15">
                                <i class="fa fa-user"></i> <span class="mr-15">My profile</span>
                                <button type="button" class="btn btn-warning btn-link" id="editProfile" value="{{Auth::user()->slug }}">
                                    Edit
                                </button>
                            </h5>

                            <div id="myProfile">
                                <p class="card-text mb-8 ml-20">
                                    <b>Profile name:</b> {{ optional(Auth::user()->profile)->name ?: 'N/A' }}
                                </p>
                                <p class="card-text mb-8 ml-20">
                                    <b>About:</b> {{ optional(Auth::user()->profile)->about  ?: 'N/A' }}
                                </p>
                                <p class="card-text ml-20">
                                    <b>Location:</b> {{ optional(Auth::user()->profile)->location  ?: 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('users.avatars.partials._modal')
    @include('users.profiles.partials._modal')
    @include('admin.settings.partials._modal')

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var adminAccountsUrl = "{{ route('admin.accounts.index') }}"

        // Edit
        var accountModal = $('#accountModal')
        var accountForm = $('#accountForm')
        var accountFields = ['name', 'email', 'password']

        accountModal.setAutofocus('_role_id')
        accountModal.emptyModal(accountFields, accountForm)

        // Profile
        var profileModal = $('#profileModal')
        var profileForm = $('#adminProfileForm')
        var profileFields = ['name', 'about', 'location']

        profileModal.setAutofocus('profileName')
        profileModal.emptyModal(profileFields, profileForm)

        // Avatar
        var avatarModal = $('#avatarModal')
        var avatarForm = $('#userAvatarForm')
        var avatarFields = ['avatar_options', 'avatar']
        var datatable

        avatarModal.setAutofocus('avatar_options')
        avatarModal.emptyModal(avatarFields, avatarForm)

        @include('admin.settings.js._edit')
        @include('admin.settings.js._JSvalidate')


        // Edit profile
        @include('users.profiles.js._edit')

        // Save profile
        @include('users.profiles.js._JSvalidation')

        //Edit avatar
        @include('users.avatars.js._edit')

        // Update avatar
        @include('users.avatars.js._JSvalidate')

    </script>

@endsection



