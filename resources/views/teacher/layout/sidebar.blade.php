<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret bg-white" id="sidenav-main" data-color="warning">



    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{route('teachers.dashboard')}}" target="_blank">
            <img src="/assets/logo-pr.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="me-1 font-weight-bold">پنل معلمین</span>
        </a>
    </div>


    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">



            <li class="nav-item">
                <a class="nav-link {{ Request::is('panel/teacher') ? 'active' : '' }}" href="{{route('teachers.dashboard')}}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-dashboard"></span>

                    </div>
                    <span class="nav-link-text me-1">داشبورد</span>
                </a>
            </li>






            <li class="nav-item">
                <a class="nav-link {{ Request::is('panel/teachers/courses*') ? 'active' : '' }}" href="{{ route('teachers.courses.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-book"></span>
                    </div>
                    <span class="nav-link-text me-1">دوره ها</span>
                </a>
            </li>










        </ul>
    </div>

</aside>



