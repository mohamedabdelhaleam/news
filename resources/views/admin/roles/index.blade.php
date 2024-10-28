@extends('layouts.app')

@section('content')
    <div class="contents">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main user-member justify-content-sm-between ">
                        <div class="d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">الصلاحيات</h4>
                            </div>


                        </div>
                        @can('add roles')
                            <div class="action-btn">
                                <a href="{{ route('dashboard.roles.create') }}" class="btn px-15 btn-primary">
                                    <i class="las la-plus fs-16"></i>اضافة صلاحية</a>
                            </div>
                        @endcan
                    </div>

                </div>
            </div>
            {{-- <div class="row mb-4 mx-4">
                <div class="d-flex align-items-center user-member__form my-sm-0 my-2">
                    <img src="{{ asset('dashboard/img/svg/search.svg') }}" alt="search" class="svg">
                    <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="search"
                        placeholder="Search by Name" aria-label="Search" id="search-input" value="{{ request('search') }}">
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="userDatatable global-shadow border-light-0 p-30 bg-white radius-xl w-100 mb-30">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th style="width: 10px">
                                            <div class="d-flex align-items-center">
                                                <div class="custom-checkbox check-all">
                                                    <input class="checkbox" type="checkbox" id="check-all">
                                                    <label for="check-all">
                                                        <span class="checkbox-text userDatatable-title"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">اسم الصلاحية</span>
                                        </th>
                                        @canany(['edit roles', 'delete roles'])
                                            <th>
                                                <span class="userDatatable-title float-end">الاجراءات</span>
                                            </th>
                                        @endcanany

                                    </tr>
                                </thead>
                                <tbody id="roles-table">
                                    @include('admin.roles.partials.roles', ['roles' => $roles])
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

