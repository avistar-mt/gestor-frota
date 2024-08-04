@extends('layouts.app')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur" data-scroll="false">
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

<div class="container-fluid my-5 py-2">
    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">

            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Novo Usuário</h5>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('user-new.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Nome</label>
                                <div class="input-group">
                                    <input id="firstname" name="firstname" class="form-control" type="text" placeholder="Nome" value="{{ old('firstname') }}">
                                </div>
                                @error('firstname')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">Sobrenome</label>
                                <div class="input-group">
                                    <input id="lastname" name="lastname" class="form-control" type="text" placeholder="Sobrenome" value="{{ old('lastname') }}">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <label class="form-label">CPF</label>
                                <div class="input-group">
                                    <input id="cpf" name="cpf" class="form-control" type="text" placeholder="000.000.000-00" value="{{ old('cpf') }}">
                                </div>
                                @error('cpf')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">Data Nascimento</label>
                                <div class="input-group">
                                    <input id="birthday" name="birthday" class="form-control datetimepicker" type="text" placeholder="dd/mm/yyyy" value="{{ old('birthday') }}">
                                </div>
                                @error('birthday')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <label class="form-label">Senha</label>
                                <div class="input-group">
                                    <input id="password" name="password" class="form-control" type="password" placeholder="Senha">
                                </div>
                                @error('password')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">Senha</label>
                                <div class="input-group">
                                    <input id="confirm-password" name="confirm-password" class="form-control" type="password" placeholder="Confirme Senha">
                                </div>
                                @error('confirm-password')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm">
                                <label class="form-label">Perfil</label>
                                <select name="role_id" id="choices-role" class="form-control">
                                    <option value="">Perfil</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == old('role') ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-sm">
                                <label class="form-label">Filial</label>
                                <select name="branch_id" id="choices-branch" class="form-control">
                                    <option value="">Filial</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ $branch->id == old('branch') ? 'selected' : '' }}>{{ $branch->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-4">Email</label>
                                <div class="input-group">
                                    <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label mt-4">Email Confirmação</label>
                                <div class="input-group">
                                    <input id="confirmation" name="confirmation" class="form-control" type="email" placeholder="example@email.com" value="{{ old('confirmation') }}">
                                </div>
                                @error('confirmation')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-4">Cidade - Estado</label>
                                <div class="input-group">
                                    <input id="location" name="location" class="form-control" type="text" value="{{ old('location') }}" placeholder="Cidade,UF">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label mt-4">Celular</label>
                                <div class="input-group">
                                    <input id="phone" name="phone" class="form-control" type="number" value="{{ old('phone') }}" placeholder="DDD + Número">
                                </div>
                                @error('phone')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row" id="driverFields" style="display: none;">
                            <div class="col-6">
                                <label class="form-label">Número da CNH</label>
                                <div class="form-group">
                                    <input type="text" name="cnh_number" id="cnh_number" class="form-control">
                                </div>
                                @error('cnh_number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">Data de Vencimento da CNH</label>
                                <div class="form-group">
                                    <input type="date" name="cnh_due_date" id="cnh_due_date" class="form-control datetimepicker">
                                </div>
                                @error('cnh_due_date')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
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
                                </div>
                                @error('cnh_category')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('user-management') }}" class="btn btn-light m-0">Volta</a>
                            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
<script src="../../../assets/js/plugins/choices.min.js"></script>
<script>
    if (document.getElementById('choices-role')) {
        var role = document.getElementById('choices-role');
        const example = new Choices(role);
    }

    if (document.getElementById('choices-branch')) {
        var branch = document.getElementById('choices-branch');
        const example = new Choices(branch);
    }


    if (document.querySelector('.datetimepicker')) {
        flatpickr('.datetimepicker', {
            allowInput: true,
            dateFormat: "d/m/Y",
            disableMobile: true,
        }); // flatpickr
    }
        if (document.querySelector('.datetimepicker')) {
        flatpickr('.datetimepicker', {
            allowInput: true,
            dateFormat: "d/m/Y",
            disableMobile: true,
        }); // flatpickr
    }

        if (document.querySelector('.datetimepicker')) {
        flatpickr('.datetimepicker', {
            allowInput: true,
            dateFormat: "d/m/Y",
        }); // flatpickr
    }

    document.getElementById('choices-role').addEventListener('change', function() {
        var driverFields = document.getElementById('driverFields');
        if (this.value == 5) {
            driverFields.style.display = 'block';
        } else {
            driverFields.style.display = 'none';
        }
    });
</script>
@endpush