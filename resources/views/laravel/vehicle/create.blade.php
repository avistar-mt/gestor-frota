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

    <div class="container-fluid my-5 py-2">
    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">

            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Novo Veiculo</h5>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('vehicle-new.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">Placa</label>
                                <div class="input-group">
                                    <input id="plate" name="plate" class="form-control" type="text" placeholder="AAA1234" value="{{ old('plate') }}">
                                </div>
                                @error('plate')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Cor</label>
                                <div class="input-group">
                                    <input id="color" name="color" class="form-control" type="text" placeholder="Cor" value="{{ old('color') }}">
                                </div>
                                @error('color')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label class="form-label">Ano</label>
                                <div class="input-group">
                                    <input id="year" name="year" class="form-control" type="text" placeholder="2020" value="{{ old('year') }}">
                                </div>
                                @error('year')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-4">
                                <label class="form-label">Modelo</label>
                                <div class="input-group">
                                    <input id="model" name="model" class="form-control" type="text" placeholder="Modelo" value="{{ old('model') }}">
                                </div>
                                @error('model')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-4">
                                <div class="form-label">Renavam</div>
                                <div class="input-group">
                                <input id="renavam" name="renavam" class="form-control" type="text" placeholder="renavam" value="{{ old('renavam') }}">
                                </div>
                                @error('renavam')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Rastreador</label>
                                <div class="input-group">
                                    <input id="tracker_number" name="tracker_number" class="form-control" type="text" placeholder="Rastreador" value="{{ old('tracker_number') }}">
                                </div>
                                @error('tracker_number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <label class="form-label">Descrição</label>
                                <div class="input-group">
                                    <textarea id="description" name="description" class="form-control" type="password" rows="4" placeholder="Descrição"> {{ old('description') }} </textarea>
                                </div>
                                @error('description')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('vehicle-management') }}" class="btn btn-light m-0">Volta</a>
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
    <script src=" {{ asset('js/app.js') }}"></script>
    <script src="/assets/js/plugins/quill.min.js"></script>
    <script>
        if (document.getElementById('editor')) {
            var quill = new Quill('#editor', {
                theme: 'snow' // Specify theme in configuration
            });
        }
    </script>
@endpush