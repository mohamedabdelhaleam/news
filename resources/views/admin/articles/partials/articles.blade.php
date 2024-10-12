@foreach ($articles as $article)
    <tr>
        <td>
            <div class="checkbox-group-wrapper">
                <div class="checkbox-group d-flex">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                        <input class="checkbox" type="checkbox" id="check-grp-content{{ $article->id }}">
                        <label for="check-grp-content{{ $article->id }}"></label>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <a href="#">{{ $article->title }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content text-truncate" style="max-width: 100px">
                <a href="#">{{ $article->description }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <a href="#">{{ optional($article->category)->name }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">

                <a href="#">{{ optional($article->user)->name }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                <a href="#">{{ $article->status }}</a>
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
                @can('delete article')
                    <li>
                        <a href="#" id="delete-article-{{ $article->id }}" class="remove">
                            <i class="uil uil-trash-alt"></i>
                        </a>
                        <form id="delete-form-{{ $article->id }}" action="{{ route('dashboard.articles.destroy', $article) }}"
                            method="POST" style="display:block;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <script>
                            document.getElementById('delete-article-{{ $article->id }}').addEventListener('click', function(event) {
                                event.preventDefault();
                                if (confirm('هل تريد حذف هذة المقالة ؟?')) {
                                    document.getElementById('delete-form-{{ $article->id }}').submit();
                                }
                            });
                        </script>
                    </li>
                @endcan
            </ul>
        </td>
    </tr>
@endforeach
