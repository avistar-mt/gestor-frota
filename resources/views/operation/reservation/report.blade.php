@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Relatórios de Reservas'])
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
        <form action="{{ route('reservation-generateReport') }}" method="POST">
            @csrf
            <div class="row mt-3">
                <div class="col">
                    <div class="card">
                        <div class="card-header justify-content-center">
                            <div class="row">
                                <div class="px-4" id="alert">
                                    @include('components.alert')
                                </div>
                                <h4>Relatório de Reservas</h4>
                                <div class="form-group col-3">
                                    <label for="start_date">Data de Início:</label>
                                    <input type="date" id="start_date" name="start_date"
                                        class="form-control datetimepicker" placeholder="DD/MM/AAAA"
                                        value="{{ request('start_date') }}">
                                    @error('start_date')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="end_date">Data de Fim:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control datetimepicker"
                                        placeholder="DD/MM/AAAA" value="{{ request('end_date') }}">
                                    @error('end_date')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="solicitante">Solicitante:</label>
                                <select id="choices-users" name="solicitante" class="form-control">
                                    <option value="">Selecione um usuário</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ (request('solicitante') == $user->id) ? 'selected' : '' }}>
                                        {{ $user->firstname . ' ' . $user->lastname }}</option>
                                    @endforeach
                                </select>
                                @error('solicitante')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary col-3">Gerar Relatório</button>

                                @if(isset($reservations) && $reservations->isNotEmpty())
                                <form action="{{ route('reservation-exportReport') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                    <input type="hidden" name="solicitante" value="{{ request('solicitante') }}">
                                    <button type="submit" class="btn btn-success col-3">Exportar Dados</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </form>

        <div class="mt-4"></div>

        @if (isset($reservations) && $reservations->isNotEmpty())
        <div class="col-12">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h2>Resultados do Relatório</h2>
                    <table class="table table-flush" id="datatable-basic">
                        <thead>
                            <tr>
                                <th>Filial</th>
                                <th>Data Incio Reserva</th>
                                <th>Data Fim Reserva </th>
                                <th>Solicitante</th>

                                <th>Status</th>
                            </tr>
                        </thead>
                </div>

                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->branch->name }}</td>
                        <td>{{ $reservation->reservation_star }}</td>
                        <td>{{ $reservation->reservation_end }}</td>
                        <td>{{ $reservation->user->firstname . ' ' . $reservation->user->lastname }}</td>
                        <td>{{ $reservation->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
@endsection

@push('js')

<script src="../../../assets/js/plugins/flatpickr.min.js"></script>
<script src="/assets/js/plugins/choices.min.js"></script>
<script src="/assets/js/plugins/datatables.js"></script>


<script>
if (document.getElementById('choices-users')) {
    var user = document.getElementById('choices-users');
    const example = new Choices(user);
}


document.addEventListener("DOMContentLoaded", function(){

    flatpickr('#start_date', {
        allowInput: true,
        dateFormat: "d/m/Y",
        defaultDate: "{{ request('start_date') }}",
    }); // flatpickr

    flatpickr('#end_date', {
        allowInput: true,
        dateFormat: "d/m/Y",
        defaultDate: "{{ request('end_date') }}",
    }); // flatpickr


})


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