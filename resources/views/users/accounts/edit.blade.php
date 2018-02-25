@extends('layouts.app')

@section('title', '| My account')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h4>
                <i class="fa fa-lock fa-panel mr-6"></i> Edit account
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('users.accounts.update', $user) }}" method="POST">

                <p class="required-fields mb-18">
                    Fields marked with <sup><i class="fa fa-asterisk fa-form"></i></sup> are required.
                </p>

                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right"><sup><i class="fa fa-asterisk fa-form red"></i></sup> Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  id="name" name="name" placeholder="Enter your name" value="{{ old('name') ?: $user->name }}" autofocus />

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right"><sup><i class="fa fa-asterisk fa-form red"></i></sup> E-Mail Address</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  id="email" name="email" placeholder="example@domain.com" value="{{ old('email') ?: $user->email }}" />

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  id="password" name="password" placeholder="Choose your password" />

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control"  id="password-confirm" name="password_confirmation" placeholder="Retype password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-warning">Save changes</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection