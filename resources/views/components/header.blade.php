<header class="header-top">
    <nav class="navbar navbar-light">
       <div class="navbar-left">
          <div class="logo-area">
             <a class="navbar-brand" style="height: 100%; object-fit: contain" href="{{ route('dashboard.admin') }}">
                <img src="{{ asset('dashboard/imdg/logo-svg.svg') }}" width="100%" height="100%" alt="logo">
             </a>
             <a href="#" class="sidebar-toggle">
                <img class="svg" src="{{ asset("dashboard/img/svg/align-center-alt.svg") }}" alt="img"></a>
          </div>
       </div>
       <!-- ends: navbar-left -->
       <div class="navbar-right">
          <ul class="navbar-right__menu">
             <!-- ends: .nav-flag-select -->
             <li class="nav-author">
                <div class="dropdown-custom">
                   <a href="javascript:;" class="nav-item-toggle"><img src="{{ asset("dashboard/img/author-nav.jpg") }}" alt="" class="rounded-circle">
                      <span class="nav-item__title">{{ explode(' ', auth('admin')->user()->name)[0] }}<i class="las la-angle-down nav-item__arrow"></i></span>
                   </a>
                   <div class="dropdown-parent-wrapper">
                      <div class="dropdown-wrapper">
                         <div class="nav-author__info">
                            <div class="author-img">
                               <img src="{{ asset("dashboard/img/author-nav.jpg") }}" alt="" class="rounded-circle">
                            </div>
                            <div>
                               <h6>{{ auth('admin')->user()->name }}</h6>
                               <span>{{ auth('admin')->user()->roles()->first()->name }}</span>
                            </div>
                         </div>
                         <div class="nav-author__options">

                            <a href="{{ route('logout') }}" class="nav-author__signout">
                               <i class="uil uil-sign-out-alt"></i> Sign Out</a>
                         </div>
                      </div>
                      <!-- ends: .dropdown-wrapper -->
                   </div>
                </div>
             </li>
             <!-- ends: .nav-author -->
          </ul>
          <!-- ends: .navbar-right__menu -->
       </div>
       <!-- ends: .navbar-right -->
    </nav>
 </header>
