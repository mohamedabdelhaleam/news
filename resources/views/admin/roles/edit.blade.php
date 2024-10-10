@extends('layouts.app')

@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">تعديل الصلاحية</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">الصلاحيات</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">تعديل صلاحية</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <form method="POST" action="{{ route('dashboard.roles.update', $role->id) }}">
                                    @csrf
                                    @method('PATCH') <!-- Use PATCH for updates -->

                                    <div class="form-group">
                                        <label for="name" class="color-dark fs-14 fw-500 align-center mb-10">اسم
                                            الصلاحية</label>
                                        <div class="with-icon">
                                            <span class="las la-tag"></span>
                                            <input type="text" name="name"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="name"
                                                value="{{ old('name', $role->name) }}" placeholder="Role Name">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="permissions"
                                            class="color-dark fs-14 fw-500 align-center mb-10">الاذونات</label>
                                        <div class="d-flex flex-wrap col-6" style="gap: 10px">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="form-check-input"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach

                                        </div>
                                        @if ($errors->has('permissions'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('permissions') }}</span>
                                        @endif
                                        @if ($errors->has('permissions.*'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('permissions.*') }}</span>
                                        @endif
                                    </div>



                                    <div class="layout-button mt-25">
                                        <button type="submit"
                                            class="btn btn-primary btn-default btn-squared px-30">تعديل</button>
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
