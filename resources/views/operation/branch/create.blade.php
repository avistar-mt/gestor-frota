@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Gerenciamento Usuário'])
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
                    <h6 class="mb-0">Nova Filial</h6>
                    <hr class="horizontal dark my-3">
                    <form method="POST" action="{{ route('branch-new.store') }}">
                        @csrf

                        <label class="mb-3">Sede</label>
                        <select class="form-select form-control" id="choices-headquarter" name="headquarters_id">
                            <option value="" selected>Selecione sede</option>
                            @foreach ($headquarters as $headquarter)
                                <option value="{{ $headquarter->id }}" {{ old('headquarters_id') == $headquarter->id ? 'selected' : '' }}>
                                    {{ $headquarter->name }}</option>
                                </option>
                            @endforeach
                        </select>
                        @error('headquarters_id')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                        @enderror

                        <label for="name" class="form-label">Nome SubFilial</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
                            @error('name')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <label class="mb-3"> Cidade</label>
                        <select class="form-select form-control" id="choices-cities" name="city_id">
                            <option value="" selected>Selecione cidade</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : 'Select City' }}>
                                    {{ $city->name . ' - ' . $city->state->uf }}</option>
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                        @enderror
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('branch-management') }}" class="btn btn-light m-0">Volta</a>
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
    <script src="/assets/js/plugins/choices.min.js"></script>

    <script>
        if (document.getElementById('editor')) {
            var quill = new Quill('#editor', {
                theme: 'snow' // Specify theme in configuration
            });
        }


        if (document.getElementById('choices-cities')) {
        var city = document.getElementById('choices-cities');
        const example = new Choices(city);
         }

        if (document.getElementById('choices-headquarter')) {
        var headquarter = document.getElementById('choices-headquarter');
        const example = new Choices(headquarter);
        }


    </script>
@endpush
