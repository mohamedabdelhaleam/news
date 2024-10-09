@extends('layouts.app')

@section('content')
    <div class="contents">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main user-member justify-content-sm-between ">
                        <div class=" d-flex flex-col flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Services</h4>
                            </div>
                            <br>



                        </div>
                        <div class="d-flex justify-between items-center gap-1">
                            @can('add services')
                                <div class="action-btn">
                                    <a href="{{ route('admin.services.add') }}" class="btn px-15 btn-primary">
                                        <i class="las la-plus fs-16"></i>Add Service</a>
                                </div>
                            @endcan
                            <div class="action-btn">
                                <a href="{{ route('admin.services.export') }}" class="btn px-15 btn-primary">
                                    <i class="uil uil-download-alt"></i>Export</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mb-4 mx-4">
                <div class="d-flex align-items-center user-member__form my-sm-0 my-2">
                    <img src="{{ asset('dashboard/img/svg/search.svg') }}" alt="search" class="svg">
                    <input class="form-control me-sm-2 border-0 box-shadow-none" id="search-input"
                        type="search" value="{{ request('search') }}" placeholder="Search by Name"
                        aria-label="Search">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="userDatatable global-shadow border-light-0 p-30 bg-white radius-xl w-100 mb-30">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th style="width: 10px">
                                            <div class="d-flex align-items-center">
                                                <div class="custom-checkbox check-all w-1 h-1">
                                                    <input class="checkbox w-1 h-1" type="checkbox" id="check-44">
                                                    <label for="check-44">
                                                        <span class="checkbox-text userDatatable-title"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Name</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Plan</span>
                                        </th>
                                        @canany(['edit services', 'delete services'])
                                            <th>
                                                <span class="userDatatable-title float-end">action</span>
                                            </th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody id="services-table">
                                    @include('admin.services.partials.services', ['services' => $services])

                                </tbody>
                            </table>
                            {{-- Modal --}}
                            <div class="modal-basic modal fade" id="modal-basic" tabindex="-1" style="display: none;"
                                aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content modal-bg-white ">
                                        <div class="modal-header">

                                            <h6 class="modal-title">Service Plan</h6>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <img src="{{ asset('dashboard/img/svg/x.svg') }}" alt="x"
                                                    class="svg">
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div id="pagination-links">
                            {{ $services->appends(['search' => request('search')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function fillModelBody(plan, name) {
            let html = `<div class="d-flex flex-wrap">`;

            plan.forEach((i, index) => {
                html +=
                    `<span class="form-control col-md-3" >${index + 1}: ${i == null ? '' : i}</span>`;
            });

            html += `</div>`;

            document.querySelector('.modal-body').innerHTML = html;
            document.querySelector('.modal-title').innerHTML = name;
        }
        activateSearchInput("{{ route('admin.services.index') }}", 'services-table', 'pagination-links');
    </script>
@endsection
