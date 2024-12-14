<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret bg-white" id="sidenav-main">



    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{route('admin.dashboard')}}" target="_blank">
            <img src="/assets/logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="me-1 font-weight-bold">پنل مدیریت</span>
        </a>
    </div>


    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">



            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{route('admin.dashboard')}}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-dashboard"></span>

                    </div>
                    <span class="nav-link-text me-1">داشبورد</span>
                </a>
            </li>




            <li class="nav-item ">
                <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-user"></span>
                    </div>
                    <span class="nav-link-text me-1">کاربران</span>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-file"></span>
                    </div>
                    <span class="nav-link-text me-1">دسته بندی</span>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/courses*') ? 'active' : '' }}" href="{{ route('admin.courses.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-book"></span>
                    </div>
                    <span class="nav-link-text me-1">دوره ها</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/blogs*') ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-book-open-reader"></span>
                    </div>
                    <span class="nav-link-text me-1">مجله</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/degrees*') ? 'active' : '' }}" href="{{ route('admin.degrees.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-sort-numeric-asc"></span>
                    </div>
                    <span class="nav-link-text me-1">مقاطع</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/comments*') ? 'active' : '' }}" href="{{ route('admin.comments.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-chart-bar"></span>
                    </div>
                    دیدگاه ها
                    @if(count(\App\Models\Comment::where('status' , 0)->get()) > 0)

                        <small class="text-info mx-1">  ({{count(\App\Models\Comment::where('status' , 0)->get())}} جدید) </small>
                    @endif
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-shopping-basket"></span>
                    </div>
                    <span class="nav-link-text me-1">سفارش ها</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/supports*') ? 'active' : '' }}" href="{{ route('admin.supports.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-headset"></span>
                    </div>
                    <span class="nav-link-text me-1"> پشتیبانی </span>
                    <small class="text-info"> ({{count(\App\Models\Support::where('parent_id' , null)->where('status' , '!=' , 'closed')->get())}})</small>

                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/contacts*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <span class="fa fa-phone"></span>
                    </div>
                    درخواست های تماس
                    @if(count(\App\Models\Contact::where('status' , 0)->get()) > 0)

                        <small class="text-info mx-1">  ({{count(\App\Models\Contact::where('status' , 0)->get())}} جدید) </small>
                    @endif
                </a>
            </li>



        </ul>
    </div>

</aside>



