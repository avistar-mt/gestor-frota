@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Notifications'])
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                <a href="javascript:;" class="nav-link p-0">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        @include('auth.logout')
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0">
                            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                    </li>
                    <li class="nav-item position-relative pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="/assets/img/team-2.jpg" class="avatar avatar-sm  me-3 "
                                                alt="user image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="/assets/img/small-logos/logo-spotify.svg"
                                                class="avatar avatar-sm bg-gradient-dark  me-3 " alt="logo spotify">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New album</span> by Travis Scott
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                1 day
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>credit-card</title>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                        fill-rule="nonzero">
                                                        <g transform="translate(1716.000000, 291.000000)">
                                                            <g transform="translate(453.000000, 454.000000)">
                                                                <path class="color-background"
                                                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                    opacity="0.593633743"></path>
                                                                <path class="color-background"
                                                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                Payment successfully completed
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                2 days
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card mt-4">
                    <div class="card-header p-3">
                        <h5 class="mb-0">Alerts</h5>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <div class="alert alert-primary alert-dismissible text-white" role="alert">
                            A simple primary alert with <a href="javascript:;" class="alert-link text-white">an example
                                link</a>. Give it a click if you like.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-secondary alert-dismissible text-white" role="alert">
                            A simple secondary alert with <a href="javascript:;" class="alert-link text-white">an example
                                link</a>. Give it a click if you like.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                            A simple success alert with <a href="javascript:;" class="alert-link text-white">an example
                                link</a>. Give it a click if you like.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-danger alert-dismissible text-white" role="alert">
                            A simple danger alert with <a href="javascript:;" class="alert-link text-white">an example
                                link</a>. Give it a click if you like.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-warning alert-dismissible text-white" role="alert">
                            A simple warning alert with <a href="javascript:;" class="alert-link text-white">an example
                                link</a>. Give it a click if you like.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-info alert-dismissible text-white" role="alert">
                            A simple info alert with <a href="javascript:;" class="alert-link text-white">an example
                                link</a>. Give it a click if you like.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-light alert-dismissible text-white" role="alert">
                            A simple light alert with <a href="javascript:;" class="alert-link text-white">an example
                                link</a>. Give it a click if you like.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-dark alert-dismissible text-white" role="alert">
                            A simple dark alert with <a href="javascript:;" class="alert-link text-white">an example
                                link</a>. Give it a click if you like.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header p-3">
                        <h5 class="mb-0">Notifications</h5>
                        <p class="text-sm mb-0">
                            Notifications on this page use Toasts from Bootstrap. Read more details <a
                                href="https://getbootstrap.com/docs/5.0/components/toasts/" target="
              ">here</a>.
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <button class="btn btn-success w-100 mb-0 toast-btn" type="button"
                                    data-target="successToast">Success Notification</button>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12 mt-sm-0 mt-2">
                                <button class="btn btn-info w-100 mb-0 toast-btn" type="button"
                                    data-target="infoToast">Info Notification</button>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
                                <button class="btn btn-warning w-100 mb-0 toast-btn" type="button"
                                    data-target="warningToast">Warning Notification</button>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
                                <button class="btn btn-danger w-100 mb-0 toast-btn" type="button"
                                    data-target="dangerToast">Danger Notification</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-fixed bottom-1 end-1 z-index-2">
            <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" id="successToast"
                aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="ni ni-check-bold text-success me-2"></i>
                    <span class="me-auto font-weight-bold">Argon Dashboard</span>
                    <small class="text-body">11 mins ago</small>
                    <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
                </div>
                <hr class="horizontal dark m-0">
                <div class="toast-body">
                    Hello, world! This is a notification message.
                </div>
            </div>
            <div class="toast fade hide p-2 mt-2 bg-gradient-info" role="alert" aria-live="assertive" id="infoToast"
                aria-atomic="true">
                <div class="toast-header bg-transparent border-0">
                    <i class="ni ni-bell-55 text-white me-2"></i>
                    <span class="me-auto text-white font-weight-bold">Argon Dashboard</span>
                    <small class="text-white">11 mins ago</small>
                    <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast"
                        aria-label="Close"></i>
                </div>
                <hr class="horizontal light m-0">
                <div class="toast-body text-white">
                    Hello, world! This is a notification message.
                </div>
            </div>
            <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="warningToast"
                aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="ni ni-spaceship text-warning me-2"></i>
                    <span class="me-auto font-weight-bold">Argon Dashboard</span>
                    <small class="text-body">11 mins ago</small>
                    <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
                </div>
                <hr class="horizontal dark m-0">
                <div class="toast-body">
                    Hello, world! This is a notification message.
                </div>
            </div>
            <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast"
                aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="ni ni-notification-70 text-danger me-2"></i>
                    <span class="me-auto text-gradient text-danger font-weight-bold">Argon Dashboard</span>
                    <small class="text-body">11 mins ago</small>
                    <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
                </div>
                <hr class="horizontal dark m-0">
                <div class="toast-body">
                    Hello, world! This is a notification message.
                </div>
            </div>
        </div>
        <!-- @include('layouts.footers.auth.footer') -->

    </div>
@endsection
