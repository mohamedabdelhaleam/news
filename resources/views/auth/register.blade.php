@extends('layouts.guest')
@section('content')
    <main class="main-content">
        <div class="admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
                        <div class="edit-profile">
                            <div class="edit-profile__logos">
                                <a href="index.html">
                                    <img class="dark" src="{{ asset('img/logo-dark.png') }}" alt="">
                                    <img class="light" src="{{ asset('img/logo-white.png') }}" alt="">
                                </a>
                            </div>
                            <div class="card border-0">
                                <div class="card-header">
                                    <div class="edit-profile__title">
                                        <h6>Sign Up to {{ env('APP_NAME') }}</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="edit-profile__body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <!-- Name -->
                                            <div class="form-group mb-25">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    :value="old('name')" required autofocus autocomplete="name"
                                                    placeholder="Enter your name">
                                                @if ($errors->has('name'))
                                                    <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>

                                            <!-- Username Address -->
                                            <div class="form-group mb-25">
                                                <label for="username">Username</label>
                                                <input type="username" class="form-control" id="username" name="username"
                                                    :value="old('username')" required autocomplete="username"
                                                    placeholder="name@example.com">
                                                @if ($errors->has('username'))
                                                    <span
                                                        class="text-red-600 text-sm">{{ $errors->first('username') }}</span>
                                                @endif
                                            </div>

                                            <!-- Password -->
                                            <div class="form-group mb-15">
                                                <label for="password-field">Password</label>
                                                <div class="position-relative">
                                                    <input id="password-field" type="password" class="form-control"
                                                        name="password" required autocomplete="new-password"
                                                        placeholder="Password">
                                                    <div
                                                        class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2">
                                                    </div>
                                                </div>
                                                @if ($errors->has('password'))
                                                    <span
                                                        class="text-red-600 text-sm">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="form-group mb-25">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Confirm Password">
                                                @if ($errors->has('password_confirmation'))
                                                    <span
                                                        class="text-red-600 text-sm">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>

                                            <div
                                                class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                                <button type="submit"
                                                    class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn">
                                                    Register
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="admin-topbar">
                                    <p class="mb-0">
                                        Already registered?
                                        <a href="{{ route('login') }}" class="color-primary">
                                            Log in
                                        </a>
                                    </p>
                                </div><!-- End: .admin-topbar  -->
                            </div><!-- End: .card -->
                        </div><!-- End: .edit-profile -->
                    </div><!-- End: .col-xl-5 -->
                </div>
            </div>
        </div><!-- End: .admin-element  -->
    </main>
@endsection
