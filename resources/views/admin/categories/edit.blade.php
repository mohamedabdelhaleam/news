@extends('layouts.app')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main">
                        <div class="breadcrumb-action justify-content-center flex-wrap">

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card-default card-md mb-4">
                        <div class="card-header">
                            <h6>تعديل المطار</h6>
                        </div>
                        <div class="card-body">
                            <div class="">
                                {{-- @include('message.message') --}}
                                <form action="{{ route('dashboard.hotels.edit', $hotel->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="form-basic row">
                                        <div class="col-md-3 mb-25">
                                            <label>الاسم</label>
                                            <input type="text" class="form-control form-control-lg" name="name"
                                                value="{{ $hotel->name }}" required>
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-25">
                                            <label>العنوان</label>
                                            <input type="text" class="form-control form-control-lg"
                                                value="{{ $hotel->location }}" name="location" required>
                                            @if ($errors->has('location'))
                                                <p class="text-danger">{{ $errors->first('location') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-lg btn-primary btn-submit">تعديل البيانات</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
