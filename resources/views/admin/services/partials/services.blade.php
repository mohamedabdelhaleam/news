@foreach ($services as $service)
    <tr>
        <td>
            <div class="checkbox-group-wrapper">
                <div class="checkbox-group d-flex">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                        <input class="checkbox" type="checkbox" id="check-grp-content12">
                        <label for="check-grp-content12"></label>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <a href="#">{{ $service->name }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <button type="button"
                    onclick="fillModelBody({{ json_encode($service->plan) }}, '{{ $service->name }}')"
                    class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-basic">Show</button>
            </div>
        </td>
        <td>
            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                @can('edit services')
                    <li>
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="edit">
                            <i class="uil uil-edit"></i>
                        </a>
                    </li>
                @endcan
                @can('delete services')
                    <li>
                        <a href="#" id="delete-service-{{ $service->id }}" class="remove">
                            <i class="uil uil-trash-alt"></i>
                        </a>
                        <form id="delete-form-{{ $service->id }}" action="{{ route('admin.services.destroy', $service) }}"
                            method="POST" style="display:block;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <script>
                            document.getElementById('delete-service-{{ $service->id }}').addEventListener('click', function(event) {
                                event.preventDefault();
                                if (confirm('Are you sure you want to delete this service?')) {
                                    document.getElementById('delete-form-{{ $service->id }}').submit();
                                }
                            });
                        </script>
                    </li>
                @endcan
            </ul>
        </td>
    </tr>
@endforeach
