@extends('layouts.app')

@section('content')
    <div class="contents">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">اضافة فئة</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">الفئات</li>
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
                                <form method="POST" class="row" action="{{ route('dashboard.categories.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group col-12">
                                        <label for="name" class=" color-dark fs-20 fw-500 align-center mb-10">الاسم
                                        </label>
                                        <div class="with-icon">
                                            <span class="uil uil-briefcase "></span>
                                            <input type="text" name="name"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="name"
                                                value="{{ old('name') }}" placeholder="اسم الفئة">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="description" class=" color-dark fs-20 fw-500 align-center mb-10">الوصف
                                        </label>
                                        <div class="with-icon">
                                            <span class="uil uil-briefcase "></span>
                                            <textarea name="description" class="form-control ih-medium ip-gray radius-xs b-light" id="" cols="30"
                                                rows="10"></textarea>
                                            {{-- <input type="text" name="name"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="description"
                                                value="{{ old('description') }}" placeholder="وصف الفئة"> --}}
                                        </div>
                                        @if ($errors->has('description'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="dm-tag-wrap">
                                                <label for="image" class="il-gray fs-14 fw-500 align-center mb-10">
                                                    الصورة الرئيسية
                                                </label>
                                                <div class="dm-tag-wrap col-12">
                                                    <div class="dm-upload  col-12">
                                                        <div class="dm-upload-avatar  col-12">
                                                            <img class="avatrSrc"
                                                                src="{{ asset('dashboard/img/upload.png') }}"
                                                                alt="Avatar Upload">
                                                        </div>
                                                        <div class="avatar-up">
                                                            <input type="file" name="image" required id="image"
                                                                class="upload-avatar-input">
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <div class="invalid-feedback d-block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="layout-button">
                                        <button type="submit"
                                            class="btn btn-primary btn-default btn-squared px-30">save</button>
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
