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
                    </ul>
                </div>
            </li>

            <!-- OPERATION -->

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#operation" class="nav-link {{ Route::currentRouteName() == 'operation' ? 'active' : ''}}" aria-controls="operation" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-end justify-content-center">
                        <i class="fa fa-folder-open" style="color: #f4645f; font-size: large; font-weight: 500 "></i>
                    </div>
                    <span class="nav-link-text ms-1">Operação</span>
                </a>
                <div class="collapse show" id="operation">
                    <ul class="nav ms-4">
                    
                        @can('manage-reservation', auth()->user())
                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'reservation-management' ? 'active' : '' }}" href="{{ route('reservation-management') }}">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal"> Reserva </span>
                            </a>
                        </li>
                        @endcan

                        @can('manage-reservation', auth()->user())
                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'reservation-managemen' ? 'active' : '' }}" href="{{ route('reservation-management') }}">
                                <span class="sidenav-mini-icon"> M </span>
                                <span class="sidenav-normal"> Multas </span>
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
                                <span class="sidenav-normal"> Usuário </span>
                            </a>
                        </li>

                        @can('manage-role', auth()->user())
                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'role-management' ? 'active' : '' }}" href="{{ route('role-management') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Perfil </span>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'city-management' ? 'active' : '' }}" href="{{ route('city-management') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Cidade </span>
                            </a>
                        </li>

                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'vehicle-management' ? 'active' : '' }}" href="{{ route('vehicle-management') }}">
                                <span class="sidenav-mini-icon"> V </span>
                                <span class="sidenav-normal"> Veículo </span>
                            </a>
                        </li>

                        @can('manage-users', auth()->user())
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'branch-management' ? 'active' : '' }}" href="{{ route('branch-management') }}">
                                <span class="sidenav-mini-icon"> F </span>
                                <span class="sidenav-normal"> Filial </span>
                            </a>
                        </li>
                        @endcan

                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'driver-management' ? 'active' : '' }}" href="{{ route('driver-management') }}">
                                <span class="sidenav-mini-icon"> M </span>
                                <span class="sidenav-normal"> Motorista </span>
                            </a>
                        </li>

                        <li class="nav-item show">
                            <a class="nav-link {{ Route::currentRouteName() == 'branch-vehicle-management' ? 'active' : '' }}" href="{{ route('branch-vehicle-management') }}">
                                <span class="sidenav-mini-icon"> F </span>
                                <span class="sidenav-normal"> Frota </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</aside>