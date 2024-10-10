<div class="sidebar-wrapper">
    <div class="sidebar sidebar-collapse" id="sidebar">
        <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
                <li>
                    <a href="{{ route('dashboard.admin') }}" class="">
                        <span class="nav-icon uil uil-create-dashboard"></span>
                        <span class="menu-text">لوحة التحكم</span>
                    </a>
                </li>
                @can('show categories')
                    <li class="">
                        <a href="{{ route('dashboard.categories.index') }}">
                            <span class="nav-icon uil uil-briefcase"></span>
                            <span class="menu-text">الفئات</span>
                        </a>
                    </li>
                @endcan
                @can('show articles')
                    <li class="">
                        <a href="{{ route('dashboard.articles.index') }}">
                            <span class="nav-icon uil uil-briefcase"></span>
                            <span class="menu-text">المقالات</span>
                        </a>
                    </li>
                @endcan
                @can('show roles')
                    <li class="">
                        <a href="{{ route('dashboard.roles.index') }}">
                            <span class="nav-icon uil uil-briefcase"></span>
                            <span class="menu-text">الصلاحيات</span>
                        </a>
                    </li>
                @endcan


            </ul>
        </div>
    </div>
</div>
