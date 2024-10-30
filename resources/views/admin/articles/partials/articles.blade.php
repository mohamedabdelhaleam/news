@foreach ($articles as $article)
    <tr id="article-row-{{ $article->id }}">
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
            <div class="userDatatable-content text-truncate" style="max-width: 200px">
                <a href="#">{{ $article->title }}</a>
            </div>
        </td>
        <td>
            <div class="userDatatable-content text-truncate" style="max-width: 200px">
                <a href="#">{!! $article->description !!}</a>
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
                @can('edit article')
                    <li>
                        <a href="{{ route('dashboard.articles.edit', $article->id) }}" class="edit">
                            <i class="uil uil-edit"></i>
                        </a>
                    </li>
                @endcan
                @can('delete article')
                    <li>
                        <a href="#" class="remove delete-article" data-id="{{ $article->id }}">
                            <i class="uil uil-trash-alt"></i>
                        </a>
                    </li>
                @endcan
            </ul>
        </td>
    </tr>
@endforeach

