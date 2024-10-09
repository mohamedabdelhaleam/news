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
                            <h6>اضافة فندق</h6>
                        </div>
                        <div class="card-body">
                            <div class="">
                                {{-- @include('message.message') --}}
                                <form action="{{ route('dashboard.hotels.show.store') }}" method="post">
                                    @csrf

                                    <div class="form-basic row">
                                        <div class="col-md-3 mb-25">
                                            <label>الاسم</label>
                                            <input type="text" class="form-control form-control-lg" name="name"
                                                required  value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-25">
                                            <label>العنوان</label>
                                            <input type="text" class="form-control form-control-lg" name="location" value="{{ old('location') }}">
                                            @if ($errors->has('location'))
                                                <p class="text-danger">{{ $errors->first('location') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-lg btn-primary btn-submit">اضافة فندق</button>
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
