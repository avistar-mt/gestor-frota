@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Gerenciamento de Reserva'])
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
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto">
            <div class="card card-body mt-4">
                <h6 class="mb-0">Nova Reserva</h6>
                <hr class="horizontal dark my-3">
                <form method="POST" action="{{ route('reservation-new.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="driver">Motorista</label>
                                <select class="form-control" id="choices-driver" name="driver_id">
                                    <option value="">Selecione motorista</option>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('driver_id')
                            <div class="text-danger text-xs pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="branch">Filial</label>
                                <select class="form-control" id="choices-branch" name="branch_id"
                                    onchange="loadVehicles()">
                                    <option value="">Selecione filial</option>
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('branch_id')
                            <div class="text-danger text-xs pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vehicle">Placa</label>
                                    <select class="form-control" id="choices-vehicles" name="vehicle_id">
                                        <option value="">Selecione placa</option>
                                        @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->plate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('vehicle_id')
                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reservation_star">Incio Reserva</label>
                                    <input type="text" class="form-control datetimepicker" id="reservation_star"
                                        autocomplete="off" placeholder="DD/MM/AAAA HH:MM" name="reservation_star" date-input>
                                </div>
                                @error('reservation_star')
                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reservation_end">Fim Reserva</label>
                                    <input type="text" class="form-control datetimepicker" autocomplete="off"
                                        placeholder="DD/MM/AAAA HH:MM" id="reservation_end" name="reservation_end" date-input>
                                </div>
                                @error('reservation_end')
                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('reservation-management') }}" class="btn btn-light m-0">Volta</a>
                            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Salvar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- @include('layouts.footers.auth.footer') -->

</div>
@endsection

@push('js')
<script src="/assets/js/plugins/quill.min.js"></script>
<script src="../../../assets/js/plugins/flatpickr.min.js"></script>
<script src="/assets/js/plugins/choices.min.js"></script>
<script>
if (document.getElementById('editor')) {
    var quill = new Quill('#editor', {
        theme: 'snow' // Specify theme in configuration
    });
}

if (document.querySelector('.datetimepicker')) {
    flatpickr('.datetimepicker', {
        allowInput: true,
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        defaultDate: new Date(),
    }); // flatpickr
}

if (document.getElementById('choices-branch')) {
    var branch = document.getElementById('choices-branch');
    const example = new Choices(branch);
}

if (document.getElementById('choices-driver')) {
    var driver = document.getElementById('choices-driver');
    const example = new Choices(driver);
}

if (document.getElementById('choices-vehicles')) {
    var vehicle = document.getElementById('choices-vehicles');
    const example = new Choices(vehicle);
}



function loadVehicles() {
    const branchId = document.getElementById('choices-branch').value;
    return branchId;
}
</script>
@endpush