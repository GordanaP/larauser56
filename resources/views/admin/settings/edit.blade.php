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
                <div class="pb-2 col-md-3 text-center">
                    @include('admin.settings.partials._avatar')
                </div>

                <div class="pb-2 col-md-9"  style="padding-left: 70px;">
                    @include('admin.settings.partials._card')
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



