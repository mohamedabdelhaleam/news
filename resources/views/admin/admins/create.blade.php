@extends('layouts.app')

@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Add Admin</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Admins</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <form method="POST" class="row" action="{{ route('dashboard.admins.store') }}">
                                    @csrf

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="name"
                                            class="color-dark fs-14 fw-500 align-center mb-10">الاسم</label>
                                        <div class="with-icon">
                                            <span class="la-user lar"></span>
                                            <input type="text" name="name"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="name"
                                                value="{{ old('name') }}" placeholder="اسم الادمن">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="username"
                                            class="color-dark fs-14 fw-500 align-center mb-10">اليوزر</label>
                                        <div class="with-icon">
                                            <span class="lar la-envelope"></span>
                                            <input type="text" name="username"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="username"
                                                value="{{ old('username') }}" placeholder="اليوزر يستخدم لتسجيل الدخول">
                                        </div>
                                        @if ($errors->has('username'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="password"
                                            class="color-dark fs-14 fw-500 align-center mb-10">كلمة السر</label>
                                        <div class="with-icon">
                                            <span class="las la-lock"></span>
                                            <input type="password" name="password" placeholder="كلمة السر"
                                                value="{{ old('password') }}"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="password_confirmation"
                                            class="color-dark fs-14 fw-500 align-center mb-10">تأكيد كلمة السر</label>
                                        <div class="with-icon">
                                            <span class="las la-lock"></span>
                                            <input type="password" name="password_confirmation"
                                                value="{{ old('password_confirmation') }}"
                                                class="form-control ih-medium ip-gray radius-xs b-light"
                                                id="password_confirmation" placeholder="تأكيد كلمة السر">
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <span
                                                class="text-red-600 text-sm">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="role"
                                            class="color-dark fs-14 fw-500 align-center mb-10">الصلاحية</label>
                                        <div class="with-icon">
                                            <span class="las la-users"></span>
                                            <select name="role" id="role"
                                                class="form-control select2 ih-medium ip-gray radius-xs b-light">
                                                <option value="" disabled selected>Select a role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('role'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('role') }}</span>
                                        @endif
                                    </div>



                                    <div class="layout-button mt-25">
                                        <button type="submit"
                                            class="btn btn-primary btn-default btn-squared px-30">أضافة</button>
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
