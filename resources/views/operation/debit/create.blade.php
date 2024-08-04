@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Gerenciamento Debito'])
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
                    <h6 class="mb-0">Novo Débito</h6>
                    <hr class="horizontal dark my-3">
                    <form method="POST" action="{{ route('debit-new.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="name" class="form-label">Reserva</label>
                        <div class="mb-3">
                            <select class="form-select form-control" id="choices-reservation" name="reservation_id">
                                <option value="" selected>Selecione reserva</option>
                                @foreach ($reservations as $reservation)
                                    <option value="{{ $reservation->id }}">
                                        {{ $reservation->id . ' - ' . $reservation->branch->name . ' - ' . $reservation->driver->firstname . ' ' . $reservation->driver->lastname }}</option>
                                    </option>
                                @endforeach
                            </select>
                            @error('reservation_id')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type"> Tipo Débito</label>
                            <select class="form-select form-control" id="choices-type" name="type">
                                <option value="">Selecione o tipo de débito</option>
                                <option value="Estacionamento">Estacionamento</option>
                                <option value="Pedagio">Pedágio</option>
                            </select>
                            
                            @error('type')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="mb-3"> Valor</label>
                            <input type="number" step="0.001" class="form-control" id="amount" name="amount" value="{{ old('amount')}}" >
                            @error('amount')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                            
                        
                        <div class="form-group">
                            <label for="data">Data</label>
                            <input type="text" name="date" id="date" class="form-control datetimepicker" >
                        </div>
                        @error('date')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                        @enderror

                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        @error('description')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                        @enderror

                        <div class="form-group">
                            <label for="image_path">Imagem</label>
                            <input class="form-control" type="file" name="image_path" id="image_path">
                        </div>
                        @error('image_path')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                        @enderror
                        
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('debit-management') }}" class="btn btn-light m-0">Volta</a>
                            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Salvar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
<script src="/assets/js/plugins/quill.min.js"></script>
<script src="/assets/js/plugins/choices.min.js"></script>
<script src="../../../assets/js/plugins/flatpickr.min.js"></script>

<script>
    if (document.getElementById('editor')) {
        var quill = new Quill('#editor', {
            theme: 'snow' // Specify theme in configuration
        });
    }

    if (document.querySelector('.datetimepicker')) {
        flatpickr('.datetimepicker', {
            allowInput: true,
            dateFormat: "d/m/Y",
        });
    }

    if (document.getElementById('choices-reservation')) {
        var reservation = document.getElementById('choices-reservation');
        const example = new Choices(reservation);
    }

    if (document.getElementById('choices-type')) {
        var type = document.getElementById('choices-type');
        const example = new Choices(type);
    }        
</script>
@endpush
