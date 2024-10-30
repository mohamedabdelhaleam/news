@foreach ($admins as $admin)
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
                <a href="#">{{ $admin->name }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                {{ $admin->username }}
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                {{ $admin->roles()->first()->name }}
            </div>
        </td>

        <td>
            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">

                @can('edit admins')
                    <li>
                        <a href="{{ route('dashboard.admins.edit', $admin->id) }}" class="edit">
                            <i class="uil uil-edit"></i>
                        </a>
                    </li>
                @endcan
                @can('delete admins')
                    <li>
                        <a href="#" id="delete-admin-{{ $admin->id }}" class="remove">
                            <i class="uil uil-trash-alt"></i>
                        </a>
                        <form id="delete-form-{{ $admin->id }}" action="{{ route('dashboard.admins.destroy', $admin) }}"
                            method="POST" style="display:block;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <script>
                            document.getElementById('delete-admin-{{ $admin->id }}').addEventListener('click', function(event) {
                                event.preventDefault();
                                if (confirm('Are you sure you want to delete this admin?')) {
                                    document.getElementById('delete-form-{{ $admin->id }}').submit();
                                }
                            });
                        </script>
                    </li>
                @endcan
            </ul>
        </td>
    </tr>
@endforeach
