@extends('layouts.app')

@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Edit Article</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Articles</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Article</li>
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
                                <form method="POST" class="row"
                                    action="{{ route('dashboard.articles.update', $article->id) }}" enctype="multipart/form-data" >
                                    @csrf
                                    @method('PATCH') <!-- Use PATCH for updates -->

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="title"
                                            class=" color-dark fs-14 fw-500 align-center mb-10">العنوان</label>
                                        <div class="with-icon">
                                            <span class="la-user lar"></span>
                                            <input type="text" name="title"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="title"
                                                value="{{ old('title', $article->title) }}" placeholder="Title">
                                        </div>
                                        @if ($errors->has('title'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="branch"
                                            class="color-dark fs-14 fw-500 align-center mb-10">الفئة</label>
                                        <div class="with-icon">
                                            <span class="las la-users"></span>
                                            <select name="category_id" id="branch"
                                                class="form-control select2 ih-medium ip-gray radius-xs b-light">
                                                <option value="" disabled selected>Select a branch</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('category_id'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="dm-tag-wrap">
                                                <label for="exampleFormControlSelect1"
                                                    class="il-gray fs-14 fw-500 align-center mb-10">
                                                    الصورة الرئيسية
                                                </label>
                                                <div class="dm-tag-wrap">
                                                    <div class="dm-upload">
                                                        <div class="dm-upload-avatar">
                                                            <img class="avatrSrc" src="{{ $article->image }}"
                                                                alt="Avatar Upload">
                                                        </div>
                                                        <div class="avatar-up">
                                                            <input type="file" name="image"
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

                                    <div class="form-group col-12 min-h-14">
                                        <label for="description"
                                            class="color-dark fs-20 fw-500 align-center mb-10">المحتوي</label>
                                        <div>
                                            <div id="editor" class="min-h-14">
                                                {!! $article->description !!}
                                            </div>
                                            <input type="hidden" name="description" id="description">
                                        </div>

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
