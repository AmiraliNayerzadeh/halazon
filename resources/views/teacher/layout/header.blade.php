<nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
     id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">

        <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none me-3">
            <a href="javascript:;" class="nav-link text-body p-0">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </a>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
            <div class="me-md-auto pe-md-3 d-flex align-items-center">

            </div>
            <ul class="navbar-nav ms-0 justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="#"
                       class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{auth()->user()->name}} {{auth()->user()->family}}</span>
                    </a>
                </li>


                <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
