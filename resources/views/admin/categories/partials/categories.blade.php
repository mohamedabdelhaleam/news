@foreach ($categories as $category)
    <tr  id="category-row-{{ $category->id }}">
        <td>
            <div class="checkbox-group-wrapper">
                <div class="checkbox-group d-flex">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                        <input class="checkbox" type="checkbox" id="check-grp-content{{ $category->id }}">
                        <label for="check-grp-content{{ $category->id }}"></label>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <img src="{{ $category->image }}" alt="" srcset="" width="100"
                    height="50">
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <a href="#">{{ $category->name }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content text-truncate" style="max-width: 100px">
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
                @can('edit category')
                    <li>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="edit">
                            <i class="uil uil-edit"></i>
                        </a>
                    </li>
                @endcan
                @can('delete category')
                    <li>
                        <a href="#" class="remove delete-category" data-id="{{ $category->id }}">
                            <i class="uil uil-trash-alt"></i>
                        </a>
                    </li>
                @endcan
            </ul>
        </td>
    </tr>
@endforeach
