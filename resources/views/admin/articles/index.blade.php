@extends('layouts.app')

@section('content')
    <div class="contents">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main user-member justify-content-sm-between ">
                        <div class=" d-flex flex-col flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">المقالات</h4>
                            </div>
                            <br>



                        </div>
                        <div class="d-flex justify-between items-center gap-1">
                            @can('add article')
                                <div class="action-btn">
                                    <a href="{{ route('dashboard.articles.create') }}" class="btn px-15 btn-primary">
                                        <i class="las la-plus fs-16"></i>اضافة مقالة</a>
                                </div>
                            @endcan

                        </div>
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
                                                <div class="custom-checkbox check-all w-1 h-1">
                                                    <input class="checkbox w-1 h-1" type="checkbox" id="check-44">
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
                                            <span class="userDatatable-title">المحتوي</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">الفئة</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">الكاتب</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">الحالة</span>
                                        </th>
                                        @canany(['edit article', 'delete article'])
                                            <th>
                                                <span class="userDatatable-title float-end">الاجراءات</span>
                                            </th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody id="services-table">
                                    @include('admin.articles.partials.articles', [
                                        'articles' => $articles,
                                    ])

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
        $(document).on('click', '.delete-article', function(event) {
            event.preventDefault();
            var articleId = $(this).data('id');

            if (confirm('هل تريد حذف هذه المقالة؟')) {
                $.ajax({
                    url: '{{ route("dashboard.articles.destroy", "") }}/' + articleId,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#article-row-' + articleId).remove();
                    },
                    error: function(xhr) {
                        alert('حدث خطأ أثناء الحذف: ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    </script>
@endsection

