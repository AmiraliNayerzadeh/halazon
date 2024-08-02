<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">

        <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">

            <ul class="navbar-nav me-auto ms-0 justify-content-end">

                <li class="nav-item d-flex align-items-center">
                    <a href="{{route('admin.users.edit', auth()->user())}}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{auth()->user()->name}} {{auth()->user()->family}}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
