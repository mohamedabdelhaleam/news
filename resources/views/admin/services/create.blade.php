@extends('layouts.app')

@section('content')
    <div class="contents">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Add Service</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">services</li>
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
                                <form method="POST" action="{{ route('admin.services.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name"
                                            class=" color-dark fs-20 fw-500 align-center mb-10">Name</label>

                                        <div class="with-icon">
                                            <span class="uil uil-briefcase "></span>
                                            <input type="text" name="name"
                                                class="form-control ih-medium ip-gray radius-xs b-light" id="name"
                                                value="{{ old('name') }}" placeholder="Service Name">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="plan"
                                            class="color-dark fs-20 fw-500 align-center mb-10">Plan</label>
                                        <div class="d-flex flex-wrap " id="planContainer">
                                            <div class="form-group position-relative col-3 me-15">
                                                <label for="plan"
                                                    class="color-dark fs-14 fw-500 align-center mb-10">No. 1</label>
                                                <input type="text" class="form-control" name="plan[]"
                                                    placeholder="No. 1">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm" id="addPlan">+</button>
                                    </div>

                                    <div class="layout-button mt-25">
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
        var phoneCount = 1;

        $('#addPlan').click(function() {
            phoneCount++;

            var clone = $('#planContainer .form-group:first').clone();
            clone.find('label').text('No. ' + phoneCount);
            clone.find('input[type="text"]')
                .attr('placeholder', 'No. ' + phoneCount)
                .val('');

            if (clone.find('a.deletePlan').length === 0) {
                clone.append(
                    '<a href="#" class="remove deletePlan position-absolute text-danger" style="top:0;right:0;"><i class="uil uil-trash-alt"></i></a>'
                );
            }

            $('#planContainer').append(clone);
        });

        $('#planContainer').on('click', 'a.deletePlan', function() {
            $(this).closest('.form-group').remove();
            phoneCount--;
            $('#planContainer .form-group').each(function(index) {
                $(this).find('label').text('No. ' + (index + 1));
                $(this).find('input[type="text"]').attr('placeholder', 'No. ' + (index + 1));
            });
        });
    </script>
@endsection
