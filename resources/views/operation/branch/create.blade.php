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
                    <h6 class="mb-0">New Branch</h6>
                    <hr class="horizontal dark my-3">
                    <form method="POST" action="{{ route('branch-new.store') }}">
                        @csrf
                        <label for="name" class="form-label">Nome</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
                            @error('name')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <label class="mb-3"> Cidade</label>
                        <select class="form-select form-control" id="choices-cities" name="city">
                            <option value="" selected>Selecione cidade</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : 'Select City' }}>
                                    {{ $city->name . ' - ' . $city->state->uf }}</option>
                                </option>
                            @endforeach
                        </select>
                        @error('description')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                        @enderror
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('branch-management') }}" class="btn btn-light m-0">Back</a>
                            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Create</button>
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


    </script>
@endpush
