@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Gerenciamento Reserva'])
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
                <h6 class="mb-0">Editar Reserva</h6>
                <hr class="horizontal dark my-3">
                <form method="POST" action="{{ route('reservation-edit.update', $reservation->id) }}">
                    @csrf

                    <table class="table-bg-primary-soft">
                        <tr>
                            <th>Motorista: </th>
                            <td>{{ strtoupper($reservation->driver->firstname) }}</td>
                        </tr>
                        <tr>
                            <th>Placa: </td>
                            <td>{{ $reservation->vehicle->plate }}</td>
                        </tr>
                        <tr>
                            <th>Filial: </td>
                            <td>{{ $reservation->branch->name }}</td>
                        </tr>
                        <tr>
                            <th>Reserva Inicio: </td>
                            <td>{{ $reservation->reservation_star }}</td>
                        </tr>
                        <tr>
                            <th>Reserva Fim: </td>
                            <td>{{ $reservation->reservation_end }}</td>
                        </tr>
                        <tr>
                            <th>Solicitante: </td>
                            <td>{{ $reservation->user->firstname . ' ' . $reservation->user->lastname }}</td>
                        </tr>
                        
                        <tr>
                            <th>Status: </td>
                            <td>{{ strtoupper($reservation->status->string()) }}</td>
                        </tr>

                        <tr>
                            <th>Aprovador Por: </td>
                            <td>{{ $reservation->approver?->name }}</td>
                        </tr>

                        <tr>
                            <th>Checklist Status:</th>
                            <tr>
                                @foreach($reservation->checkins as $checkin)
                                <tr>
                                    <th>{{ $checkin->step?->string() }}: </th>  
                                    <td>{{ $checkin->status?->string() }}</td>
                                </tr>
                                    @endforeach
                            </tr>
                        </tr>

                    </table>

                    <div class=" d-flex justify-content-end mt-4">
                        <a href="{{ route('reservation-management') }}" class="btn btn-light m-0">Volta</a>
                        @unless($reservation->approved_by)
                        <button type="submit" name="status" value="approved" class="btn btn-success m-0 ms-2">Aprovar</button>
                        <button type="button" class="btn btn-danger m-0 ms-2" data-bs-toggle="modal" data-bs-target="#rejectModal">Negar</button>

                        <!-- Reject Modal -->
                        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel">Cancelamento Reserva</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="motive" class="form-label">Motivo</label>
                                        <textarea class="form-control" id="motive" name="motive" placeholder="Informe o motivo pelo qual está sendo rejeitado"></textarea>
                                        @error('motive')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" name="status" value="canceled" class="btn btn-danger">Rejeitar</button>
                                    </div>
                                </div>
                            </div>
                            @endunless
                        </div>
                    </div>
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

<script>
    if (document.getElementById('editor')) {
        var quill = new Quill('#editor', {
            theme: 'snow' // Specify theme in configuration
        });
    }

    if (document.querySelector('.datetimepicker')) {
        flatpickr('.datetimepicker', {
            mode: "mutiple",
            allowInput: true,
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            defaultDate: [`{{ date("d/m/Y H:i",strtotime($reservation->reservation_star)) }}`],
            disableMobile: true,
        }); // flatpickr
    }


    function loadVehicles() {
        const branchId = document.getElementById('branch_id').value;
        const vehicleSelect = document.getElementById('vehicle_id');
        vehicleSelect.innerHTML = '<option value="">Carregando...</option>';

        fetch(`${window.location.origin}/api/vehicles-for-branch/${branchId}`)
            .then(response => response.json())
            .then(vehicles => {
                vehicleSelect.innerHTML = '<option value="">Selecione um Veículo</option>';
                vehicles.forEach(vehicle => {
                    vehicleSelect.innerHTML += `<option value="${vehicle.id}">${vehicle.plate}</option>`;
                });
            }).catch(() => {
                vehicleSelect.innerHTML = '<option value="">Erro ao carregar veículos</option>';
            })
    }
</script>
@endpush