@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Gerenciamento Veiculo'])
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
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Gerenciamento Veiculo</h5>
                        @can('manage-vehicle', auth()->user())
                            <a href="{{ route('vehicle-new') }}" class="btn bg-gradient-dark btn-sm float-end mb-0">Adicionar Veiculo</a>
                        @endcan
                    </div>
                    <div class="px-4" id="alert">
                        @include('components.alert')
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Placa
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Modelo
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ano
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Rastreador
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td class="text-sm font-weight-normal">{{ $vehicle->plate }}</td>
                                        <td class="text-sm font-weight-normal">{{ $vehicle->model}}</td>
                                        <td class="text-sm font-weight-normal">{{ $vehicle->year }}</td>
                                        <td class="text-sm font-weight-normal">{{ $vehicle->tracker_number }}</td>
                
                                        <td class="text-sm">
                                            <span class="d-flex">
                                                @can('edit-vehicle', auth()->user())
                                                    <a href="{{ route('vehicle-edit', $vehicle->id) }}" class="me-3" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit vehicle">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    @endcan
                                                    @can('delete-vehicle', auth()->user())
                                                    <form action="{{ route('vehicle-destroy', $vehicle->id) }}" method="post">
                                                        @csrf
                                                        <button onclick="if(!confirm('Você deseja deletar o veículo?')) { event.preventDefault(); }"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Delete branch"
                                                            class="border-0 bg-white">
                                                            <i class="fas fa-trash text-secondary"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- @include('layouts.footers.auth.footer') -->

    </div>
@endsection

@push('js')
    <script src="/assets/js/plugins/datatables.js"></script>
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
            searchable: true,
            fixedHeight: true,
            columns: [{
                select: [3],
                sortable: false
            }]
        });
    </script>
@endpush
