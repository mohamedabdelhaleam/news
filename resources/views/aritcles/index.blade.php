@section('title', __('pages.answers'))
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
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header color-dark fw-500">
                            <p>الفنادق</p>

                        </div>
                        <div class="card-body p-0">
                            <div class="table4 p-25 mb-30">
                                {{-- @can('add-user') --}}
                                <a href="{{ route('dashboard.hotels.show.create.form') }}"
                                    class="btn btn-primary my-2">اضافة فندق</a>
                                {{-- @endcan --}}
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr class="userDatatable-header">
                                                <th>
                                                    <span class="userDatatable-title">#</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">الاسم</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">الموقع</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">الاجراءات</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($hotels) > 0)
                                                @foreach ($hotels as $hotel)
                                                    <tr id="ho_{{ $hotel->id }}">
                                                        <td>
                                                            <div class="userDatatable-content">
                                                                {{ $loop->iteration }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="userDatatable-content">
                                                                {{ $hotel->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="userDatatable-content text-truncate"
                                                                style="max-width: 100px">
                                                                {{ $hotel->location }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="userDatatable-content d-flex gap-3">
                                                                <a href="{{ route('dashboard.hotels.show.edit', ['id' => $hotel->id]) }}"
                                                                    class=" p-2 rounded" title="Edit"><i
                                                                        class="fs-5 text-primary uil uil-edit"></i>
                                                                </a>

                                                                <a rel="nofollow" onclick="deleteHotel({{ $hotel->id }})"
                                                                    class="p-2 rounded"
                                                                    style="cursor: pointer !important ; font-size: 20px !important "
                                                                    title="Delete"><i
                                                                        class="text-danger uil uil-trash-alt"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function deleteHotel(id) {
            if (confirm('هل تريد حذف هذا الفندق؟')) {
                $.ajax({
                    url: "{{ route('dashboard.hotels.destroy', '') }}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(responseData) {
                        $('#ho_' + id).remove();
                    },
                    error: function(xhr, status, error) {

                        console.error('Request failed with status:', status);
                    }
                });
            }
        }
    </script>
@endsection
