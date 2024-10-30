@extends('layouts.app')

@section('content')
    <div class="contents">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main user-member justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Admins</h4>
                            </div>
                        </div>
                        @can('add admins')
                            <div class="action-btn">
                                <a href="{{ route('dashboard.admins.create') }}" class="btn px-15 btn-primary">
                                    <i class="las la-plus fs-16"></i>أضافة أدمن</a>
                            </div>
                        @endcan
                    </div>

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
                                                <div class="custom-checkbox check-all">
                                                    <input class="checkbox" type="checkbox" id="check-44">
                                                    <label for="check-44">
                                                        <span class="checkbox-text userDatatable-title"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">الاسم</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">اليوزر</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">الصلاحية</span>
                                        </th>

                                        @canany(['edit admins', 'delete admins'])
                                            <th>
                                                <span class="userDatatable-title float-end">الاجراءات</span>
                                            </th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody id="admins-table">
                                    @include('admin.admins.partials.admins', ['admins' => $admins])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).on('click', '.delete-admin', function(event) {
            event.preventDefault();
            var adminId = $(this).data('id');

            if (confirm('هل تريد حذف هذه الشخص ؟')) {
                $.ajax({
                    url: '{{ route("dashboard.admins.destroy", "") }}/' + adminId,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#admin-row-' + adminId).remove();
                    },
                    error: function(xhr) {
                        alert('حدث خطأ أثناء الحذف: ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    </script>
@endsection
