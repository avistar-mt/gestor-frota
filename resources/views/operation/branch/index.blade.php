@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Gerenciamento Filial'])
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
                        <h5 class="mb-0">Gerenciamento Filial</h5>
                        @can('create-branch', auth()->user())
                            <a href="{{ route('branch-new') }}" class="btn bg-gradient-dark btn-sm float-end mb-0">Adicionar Filial</a>
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
                                        Nome
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Cidade
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Data Criação
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <td class="text-sm font-weight-normal">{{ $branch->name }}</td>
                                        <td class="text-sm font-weight-normal">{{ $branch->city . '-' . $branch->state  }}</td>
                                        <td class="text-sm font-weight-normal">{{ $branch->created_at->format('d/m/y H:i:s') }}</td>
                                        <td class="text-sm">
                                            <span class="d-flex">
                                                @can('edit-branch', auth()->user())
                                                    <a href="{{ route('branch-edit', $branch->id) }}" class="me-3" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit branch">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-branch', auth()->user())
                                                    <form action="{{ route('branch-destroy', $branch->id) }}" method="post">
                                                        @csrf
                                                        <button onclick="if(!confirm('Deseja deletar a filial?')) {event.preventDefault();}"
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
