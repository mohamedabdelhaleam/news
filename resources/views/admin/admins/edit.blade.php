@extends('layouts.app')

@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Edit Admin</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Admins</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <form method="POST" action="{{ route('admin.admins.update', $admin->id) }}">
                                    @csrf
                                    @method('PATCH') <!-- Use PATCH for updates -->

                                    <div class="form-group">
                                        <label for="name"
                                            class=" color-dark fs-14 fw-500 align-center mb-10">Name</label>
                                        <div class="with-icon">
                                            <span class="la-user lar"></span>
                                            <input type="text" name="name"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="name"
                                                value="{{ $admin->name }}" placeholder="Admin Name">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="username"
                                            class=" color-dark fs-14 fw-500 align-center mb-10">Username</label>
                                        <div class="with-icon">
                                            <span class="lar la-envelope"></span>
                                            <input type="text" name="username"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="username"
                                                value="{{ $admin->username }}"
                                                placeholder="Admin Username (used for login)">
                                        </div>
                                        @if ($errors->has('username'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password"
                                            class=" color-dark fs-14 fw-500 align-center mb-10">Password</label>
                                        <div class="with-icon">
                                            <span class="las la-lock"></span>
                                            <input type="password" name="password"
                                                placeholder="Password (leave blank to keep current)"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation"
                                            class=" color-dark fs-14 fw-500 align-center mb-10">Confirm Password</label>
                                        <div class="with-icon">
                                            <span class="las la-lock"></span>
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm Password"
                                                class="form-control ih-medium ip-gray radius-xs b-light"
                                                id="password_confirmation">
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <span
                                                class="text-red-600 text-sm">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="role"
                                            class="color-dark fs-14 fw-500 align-center mb-10">Role</label>
                                        <div class="with-icon">
                                            <span class="las la-users"></span>
                                            <select name="role" id="role"
                                                class="form-control select2 ih-medium ip-gray radius-xs b-light">
                                                <option value="" disabled selected>Select a role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $admin->roles()->first()->id == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('role'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('role') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="branch"
                                            class="color-dark fs-14 fw-500 align-center mb-10">Branch</label>
                                        <div class="with-icon">
                                            <span class="las la-code-branch"></span>
                                            <select name="branch" id="branch"
                                                class="form-control select2 ih-medium ip-gray radius-xs b-light">
                                                <option value="" selected>Select a branch</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        {{ optional($admin->branch)->id == $branch->id ? 'selected' : '' }}>
                                                        {{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('branch'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('branch') }}</span>
                                        @endif
                                    </div>

                                    <div class="layout-button mt-25">
                                        <button type="submit"
                                            class="btn btn-primary btn-default btn-squared px-30">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ends: .card -->
                </div>
            </div>
        </div>
    </div>
@endsection
