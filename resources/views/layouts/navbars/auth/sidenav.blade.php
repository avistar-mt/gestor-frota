<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-2
    {{ $bg ?? ''}} {{ $box ?? ''}}" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('dashboards', ['page' => 'default']) }}">
            <img src="{{ $logo ?? '/assets/img/logo-ct-dark.png'}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Gestor Frota</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link {{ Route::currentRouteName() == 'dashboards' ? 'active' : '' }}" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10" style="font-size:large;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboards</span>
                </a>
                <div class="collapse {{ Route::currentRouteName() == 'dashboards' ? 'show' : '' }} " id="dashboardsExamples">
                    <ul class="nav ms-4">
                        <li class="nav-item active">
                            <a class="nav-link {{ str_contains(request()->url(), 'default') == true ? 'active' : '' }}" href="{{ route('dashboards', ['page' => 'default']) }}">
                                <span class="sidenav-mini-icon"> D </span>
                                <span class="sidenav-normal"> Default </span>
                            </a>
                        </li>
                        <!-- <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'automotive') == true ? 'active' : '' }}" href="{{ route('dashboards', ['page' => 'automotive']) }}">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal"> Automotive </span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'smart-home') == true ? 'active' : '' }}" href="{{ route('dashboards', ['page' => 'smart-home']) }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal"> Smart Home </span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item ">
                            <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false"
                                href="#vrExamples">
                                <span class="sidenav-mini-icon"> V </span>
                                <span class="sidenav-normal"> Virtual Reality <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="vrExamples">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'vr-default') == true ? 'active' : '' }}" href="{{ route('dashboards', ['page' => 'vr-default']) }}">
                                            <span class="sidenav-mini-icon text-xs"> V </span>
                                            <span class="sidenav-normal"> VR Default </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link{{ str_contains(request()->url(), 'vr-info') == true ? 'active' : '' }}" href="{{ route('dashboards', ['page' => 'vr-info']) }}">
                                            <span class="sidenav-mini-icon text-xs"> V </span>
                                            <span class="sidenav-normal"> VR Info </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <!-- <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'crm') == true ? 'active' : '' }}" href="{{ route('dashboards', ['page' => 'crm']) }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> CRM </span>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </li>



            <!-- OPERATION -->

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#operation" class="nav-link {{ Route::currentRouteName() == 'operation' ? 'active' : ''}}" aria-controls="operation" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-end justify-content-center">
                        <i class="fa fa-folder-open" style="color: #f4645f; font-size: large; font-weight: 500 "></i>
                    </div>
                    <span class="nav-link-text ms-1">Operation </span>
                </a>
                <div class="collapse show" id="operation">
                    <ul class="nav ms-4">
                        @can('manage-users', auth()->user())
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'branch-management' ? 'active' : '' }}" href="{{ route('branch-management') }}">
                                <span class="sidenav-mini-icon"> B </span>
                                <span class="sidenav-normal"> Branch </span>
                            </a>
                        </li>
                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'reservation-management' ? 'active' : '' }}" href="{{ route('reservation-management') }}">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal"> Reservation </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>



            <!-- CADASTRO -->
            <li class="nav-item mt-3">
                <a data-bs-toggle="collapse" href="#cadastro" class="nav-link" aria-controls="cadastro" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-end justify-content-center">
                        <i class="fa fa-check-square-o" style="color: #f4645f; font-size: large; font-weight: 500 "></i>
                    </div>
                    <span class="nav-link-text ms-1">Cadastro </span>
                </a>

                <div class="collapse show" id="cadastro">
                    <ul class="nav ms-4">
                    <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'user-management' ? 'active' : '' }}" href="{{ route('user-management') }}">
                                <span class="sidenav-mini-icon"> U </span>
                                <span class="sidenav-normal"> User Management </span>
                            </a>
                        </li>
                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'role-management' ? 'active' : '' }}" href="{{ route('role-management') }}">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal"> Role Management </span>
                            </a>
                        </li>
                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'city-management' ? 'active' : '' }}" href="{{ route('city-management') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> City </span>
                            </a>
                        </li>

                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'vehicle-management' ? 'active' : '' }}" href="{{ route('vehicle-management') }}">
                                <span class="sidenav-mini-icon"> V </span>
                                <span class="sidenav-normal"> Vehicles </span>
                            </a>
                        </li>

                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'driver-management' ? 'active' : '' }}" href="{{ route('driver-management') }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal"> Drivers </span>
                            </a>
                        </li>

                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'branch-vehicle-management' ? 'active' : '' }}" href="{{ route('branch-vehicle-management') }}">
                                <span class="sidenav-mini-icon"> BV </span>
                                <span class="sidenav-normal"> Branch Vehicles </span>
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">PAGES</h6>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link {{ str_contains(request()->url(), 'pages') == true ? 'active' : '' }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pages</span>
                </a>
                <div class="collapse {{ str_contains(request()->url(), 'pages') == true ? 'show' : '' }}" id="pagesExamples">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'profile') == true ? 'active' : '' }}" aria-controls="profileExample" data-bs-toggle="collapse" aria-expanded="false" role="button" href="#profileExample">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Profile <b class="caret"></b></span>
                            </a>
                            <div class="collapse {{  Route::currentRouteName() == 'profiles' ? 'show' : '' }}" id="profileExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'overview') == true ? 'active' : '' }}" href="{{ route('profiles', ['page' => 'overview']) }}">
                                            <span class="sidenav-mini-icon text-xs"> P </span>
                                            <span class="sidenav-normal"> Profile Overview </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'teams') == true ? 'active' : '' }}" href="{{ route('profiles', ['page' => 'teams']) }}">
                                            <span class="sidenav-mini-icon text-xs"> T </span>
                                            <span class="sidenav-normal"> Teams </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'projects') == true ? 'active' : '' }}" href="{{ route('profiles', ['page' => 'projects']) }}">
                                            <span class="sidenav-mini-icon text-xs"> A </span>
                                            <span class="sidenav-normal"> All Projects </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="false" role="button" href="#usersExample">
                                <span class="sidenav-mini-icon"> U </span>
                                <span class="sidenav-normal"> Users <b class="caret"></b></span>
                            </a>
                            <div class="collapse {{  Route::currentRouteName() == 'users' ? 'show' : '' }}" id="usersExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'reports') == true ? 'active' : '' }}" href="{{ route('users', ['page' => 'reports']) }}">
                                            <span class="sidenav-mini-icon text-xs"> R </span>
                                            <span class="sidenav-normal"> Reports </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'new-user') == true ? 'active' : '' }}" href="{{ route('users', ['page' => 'new-user']) }}">
                                            <span class="sidenav-mini-icon text-xs"> N </span>
                                            <span class="sidenav-normal"> New User </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'accounts' ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="false" href="#accountExample">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal"> Account <b class="caret"></b></span>
                            </a>
                            <div class="collapse {{ Route::currentRouteName() == 'accounts' ? 'show' : '' }}" id="accountExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'settings') == true ? 'active' : '' }}" href="{{ route('accounts', ['page' => 'settings']) }}">
                                            <span class="sidenav-mini-icon text-xs"> S </span>
                                            <span class="sidenav-normal"> Settings </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'billing') == true ? 'active' : '' }}" href="{{ route('accounts', ['page' => 'billing']) }}">
                                            <span class="sidenav-mini-icon text-xs"> B </span>
                                            <span class="sidenav-normal"> Billing </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'invoice') == true ? 'active' : '' }}" href="{{ route('accounts', ['page' => 'invoice']) }}">
                                            <span class="sidenav-mini-icon text-xs"> I </span>
                                            <span class="sidenav-normal"> Invoice </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'security') == true ? 'active' : '' }}" href="{{ route('accounts', ['page' => 'security']) }}">
                                            <span class="sidenav-mini-icon text-xs"> S </span>
                                            <span class="sidenav-normal"> Security </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'projects' ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="false" href="#projectsExample">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Projects <b class="caret"></b></span>
                            </a>
                            <div class="collapse {{ Route::currentRouteName() == 'projects' ? 'show' : '' }}" id="projectsExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'general') == true ? 'active' : '' }}" href="{{ route('projects', ['page' => 'general']) }}">
                                            <span class="sidenav-mini-icon text-xs"> G </span>
                                            <span class="sidenav-normal"> General </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'timeline') == true ? 'active' : '' }}" href="{{ route('projects', ['page' => 'timeline']) }}">
                                            <span class="sidenav-mini-icon text-xs"> T </span>
                                            <span class="sidenav-normal"> Timeline </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), 'new-project') == true ? 'active' : '' }}" href="{{ route('projects', ['page' => 'new-project']) }}">
                                            <span class="sidenav-mini-icon text-xs"> N </span>
                                            <span class="sidenav-normal"> New Project </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'pricing-page') == true ? 'active' : '' }}" href="{{ route('pages', ['page' => 'pricing-page']) }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Pricing Page </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'rtl') == true ? 'active' : '' }}" href="{{ route('pages', ['page' => 'rtl']) }}">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal"> RTL </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'widgets') == true ? 'active' : '' }}" href="{{ route('pages', ['page' => 'widgets']) }}">
                                <span class="sidenav-mini-icon"> W </span>
                                <span class="sidenav-normal"> Widgets </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'charts') == true ? 'active' : '' }}" href="{{ route('pages', ['page' => 'charts']) }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Charts </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'sweet-alerts') == true ? 'active' : '' }}" href="{{ route('pages', ['page' => 'sweet-alerts']) }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal"> Sweet Alerts </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'notifications') == true ? 'active' : '' }}" href="{{ route('pages', ['page' => 'notifications']) }}">
                                <span class="sidenav-mini-icon"> N </span>
                                <span class="sidenav-normal"> Notifications </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#applicationsExamples" class="nav-link {{ Route::currentRouteName() == 'applications' ? 'active' : '' }}" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ui-04 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Applications</span>
                </a>
                <div class="collapse {{ Route::currentRouteName() == 'applications' ? 'show' : '' }}" id="applicationsExamples">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'kanban') == true ? 'active' : '' }}" href="{{ route('applications', ['page' => 'kanban']) }}">
                                <span class="sidenav-mini-icon"> K </span>
                                <span class="sidenav-normal"> Kanban </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'wizard') == true ? 'active' : '' }}" href="{{ route('applications', ['page' => 'wizard']) }}">
                                <span class="sidenav-mini-icon"> W </span>
                                <span class="sidenav-normal"> Wizard </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link  {{ str_contains(request()->url(), 'datatables') == true ? 'active' : '' }}" href="{{ route('applications', ['page' => 'datatables']) }}">
                                <span class="sidenav-mini-icon"> D </span>
                                <span class="sidenav-normal"> DataTables </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'calendar') == true ? 'active' : '' }}" href="{{ route('applications', ['page' => 'calendar']) }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Calendar </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ str_contains(request()->url(), 'analytics') == true ? 'active' : '' }}" href="{{ route('applications', ['page' => 'analytics']) }}">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal"> Analytics </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</aside>