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
                                <form method="POST" class="row" action="{{ route('dashboard.categories.store') }}">
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

                                    <!-- Quill Editor -->
                                    <div class="form-group col-12 min-h-14">
                                        <label for="description"
                                            class="color-dark fs-20 fw-500 align-center mb-10">الوصف</label>
                                        <div>
                                            <div id="editor" class="min-h-14">

                                            </div>
                                            <input type="hidden" name="description" id="description">
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

@section('script')
    <script>
        quill.format('direction', 'rtl');
        quill.format('align', 'right');
        document.querySelector('form').addEventListener('submit', function() {
            var descriptionInput = document.querySelector('#description');
            descriptionInput.value = quill.root.innerHTML;
        });
    </script>
@endsection
