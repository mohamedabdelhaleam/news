@foreach ($categories as $category)
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
                <a href="#">{{ $category->name }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <a href="#">{{ $category->description }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <a href="#">{{ $category->status }}</a>
            </div>
        </td>
        <td>
            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                @can('edit services')
                    <li>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="edit">
                            <i class="uil uil-edit"></i>
                        </a>
                    </li>
                @endcan
                @can('delete services')
                    <li>
                        <a href="#" id="delete-service-{{ $category->id }}" class="remove">
                            <i class="uil uil-trash-alt"></i>
                        </a>
                        <form id="delete-form-{{ $category->id }}" action="{{ route('dashboard.categories.destroy', $category) }}"
                            method="POST" style="display:block;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <script>
                            document.getElementById('delete-service-{{ $category->id }}').addEventListener('click', function(event) {
                                event.preventDefault();
                                if (confirm('هل تريد حذف هذة الفئة ؟?')) {
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
