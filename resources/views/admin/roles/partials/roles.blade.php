@foreach ($roles as $role)
                                        <tr>
                                            <td>
                                                <div class="checkbox-group-wrapper">
                                                    <div class="checkbox-group d-flex">
                                                        <div
                                                            class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                            <input class="checkbox" type="checkbox"
                                                                id="check-role-{{ $role->id }}">
                                                            <label for="check-role-{{ $role->id }}"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    <a href="#">{{ $role->name }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                    @can('edit roles')
                                                        <li>
                                                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="edit">
                                                                <i class="uil uil-edit"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('delete roles')
                                                        <li>
                                                            <a href="#" id="delete-role-{{ $role->id }}"
                                                                class="remove">
                                                                <i class="uil uil-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $role->id }}"
                                                                action="{{ route('dashboard.roles.destroy', $role->id) }}"
                                                                method="POST" style="display:none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <script>
                                                                document.getElementById('delete-role-{{ $role->id }}').addEventListener('click', function(event) {
                                                                    event.preventDefault();
                                                                    if (confirm('Are you sure you want to delete this role?')) {
                                                                        document.getElementById('delete-form-{{ $role->id }}').submit();
                                                                    }
                                                                });
                                                            </script>

                                                        </li>
                                                    @endcan
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
