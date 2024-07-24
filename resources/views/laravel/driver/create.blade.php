@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Gerenciamento Motorista'])
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

            <!-- Card Informações Básicas -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Novo Motorista</h5>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('driver-new.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <label class="form-label">Nome</label>
                                <div class="input-group">
                                    <input id="name" name="name" class="form-control" type="text" placeholder="nome" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-label">CPF</label>
                                <div class="input-group">
                                    <input id="cpf" name="cpf" class="form-control" type="text" placeholder="000.000.000-00" value="{{ old('cpf') }}">
                                </div>
                                @error('cpf')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-label">Data Nascimento</label>
                                <div class="input-group">
                                    <input id="birth_date" name="birth_date" class="form-control datetimepicker" placeholder="DD/MM/AAAA" value="{{ old('birth_date') }}">
                                </div>
                                @error('birth_date')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-label">Telefone</label>
                                <div class="input-group">
                                    <input id="phone" name="phone" class="form-control" type="text" placeholder="+65 9999 9999" value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-4">
                                <label class="form-label">CNH</label>
                                <div class="input-group">
                                    <input id="cnh_number" name="cnh_number" class="form-control" type="text" placeholder="CNH" value="{{ old('cnh_number') }}">
                                </div>
                                @error('cnh_number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label class="form-label">Categoria CNH</label>

                                    <select id="choices-category" name="cnh_category" class="form-control">
                                        <option value=""> Categorias</option>
                                        <option value="A" {{ old('cnh_category') == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('cnh_category') == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="AB" {{ old('cnh_category') == 'AB' ? 'selected' : '' }}>AB</option>
                                        <option value="AC" {{ old('cnh_category') == 'AC' ? 'selected' : '' }}>AC</option>
                                        <option value="AD" {{ old('cnh_category') == 'AD' ? 'selected' : '' }}>AD</option>
                                        <option value="D" {{ old('cnh_category') == 'D' ? 'selected' : '' }}>D</option>
                                        <option value="E" {{ old('cnh_category') == 'E' ? 'selected' : '' }}>E</option>
                                        <option value="AE" {{ old('cnh_category') == 'AE' ? 'selected' : '' }}>AE</option>
                                        <option value="A1" {{ old('cnh_category') == 'A1' ? 'selected' : '' }}>A1</option>
                                        <option value="A2" {{ old('cnh_category') == 'A2' ? 'selected' : '' }}>A2</option>
                                        <option value="B1" {{ old('cnh_category') == 'B1' ? 'selected' : '' }}>B1</option>
                                        <option value="B2" {{ old('cnh_category') == 'B2' ? 'selected' : '' }}>B2</option>
                                        <option value="B3" {{ old('cnh_category') == 'B3' ? 'selected' : '' }}>B3</option>
                                        <option value="C1" {{ old('cnh_category') == 'C1' ? 'selected' : '' }}>C1</option>
                                        <option value="C2" {{ old('cnh_category') == 'C2' ? 'selected' : '' }}>C2</option>
                                        <option value="C3" {{ old('cnh_category') == 'C3' ? 'selected' : '' }}>C3</option>

                                    </select>       
                                
                                @error('cnh_category')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label class="form-label">Data de Vencimento da CNH</label>
                                <div class="input-group">
                                    <input id="cnh_due_date" name="cnh_due_date" class="form-control datetimepicker" placeholder="DD/MM/AAAA" value="{{ old('cnh_due_date') }}">
                                </div>
                                @error('cnh_due_date')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-4">
                                <label class="form-label">Rua</label>
                                <div class="input-group">
                                    <input id="street" name="street" class="form-control" type="text" placeholder="Rua" value="{{ old('street')}}">
                                </div>
                                @error('street')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-2">
                                <label class="form-label">Número</label>
                                <div class="input-group">
                                    <input id="number" name="number" class="form-control" type="text" placeholder="Número" value="{{ old('number') }}">
                                </div>
                                @error('number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label class="form-label">Cidade</label>
                                <div class="input-group">
                                    <input id="city" name="city" class="form-control" type="text" placeholder="Cidade" value="{{ old('city') }}">
                                </div>
                                @error('city')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label class="form-label">Estado</label>
                                <div class="input-group">
                                    <input id="state" name="state" class="form-control" type="text" placeholder="estado" value="{{ old('state') }}">
                                </div>
                                @error('state')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status_checkbox">
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                                <input type="hidden" name="status" id="status" value="active">

                                <script>
                                    const statusCheckbox = document.getElementById('status_checkbox');
                                    const statusHiddenInput = document.getElementById('status');

                                    statusCheckbox.addEventListener('change', function() {
                                        if (this.checked) {
                                            statusHiddenInput.value = 'active';
                                        } else {
                                            statusHiddenInput.value = 'inactive';
                                        }
                                    });
                                </script>
                                @error('status')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('driver-management') }}" class="btn btn-light m-0">Volta</a>
                            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- @include('layouts.footers.auth.footer') -->
</div>
@endsection

@push('css')
<style>
    .choices {
        margin-bottom: 0;
    }
</style>
@endpush

@push('js')
<script src=" {{ asset('js/app.js') }}"></script>
<script src="../../../assets/js/plugins/flatpickr.min.js"></script>
<script src="/assets/js/plugins/choices.min.js"></script>
<script>

    if (document.getElementById('choices-role')) {
        var role = document.getElementById('choices-role');
        const example = new Choices(role);
    }

    if (document.getElementById('choices-branch')) {
        var branch = document.getElementById('choices-branch');
        const example = new Choices(branch);
    }

    if (document.getElementById('choices-category')) {
        var category = document.getElementById('choices-category');
        const example = new Choices(category);
    }

    if (document.querySelector('.datetimepicker')) {
                flatpickr('.datetimepicker', {
                    allowInput: true,
                    dateFormat: "d/m/Y",
                }); // flatpickr
            }
</script>
@endpush