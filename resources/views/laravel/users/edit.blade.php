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

    <div class="container-fluid my-5 py-2">
        <div class="d-flex justify-content-center mb-5">
            <div class="col-lg-9 mt-lg-0 mt-4">

                <!-- Card Basic Info -->
                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5>Editar Usário</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form method="POST" action="{{ route('user-edit.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label class="form-label">Nome</label>
                                    <div class="input-group">
                                        <input id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" class="form-control" type="text" placeholder="Nome" >
                                    </div>
                                    @error('firstname')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Sobrenome</label>
                                    <div class="input-group">
                                        <input id="lastname" name="lastname" value="{{ old('lastname') ?? $user->lastname }}" class="form-control" type="text" placeholder="Sobrenome">
                                    </div>
                                </div>
                                @error('lastname')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label class="form-label">CPF</label>
                                    <div class="input-group">
                                        <input id="cpf" name="cpf" value="{{ old('cpf', $user->cpf) }}" class="form-control" type="text" placeholder="000.000.000-00">
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
                            <div class="row mt-4">
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
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->id == old('role', $user->role_id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <label class="form-label">Filial</label>
                                    <select name="branch_id[]" id="choices-branch" class="form-control" multiple>
                                        @foreach ($branches as $id => $branch)
                                        <option value="{{ $id }}" {{ isset($selectedBranches) && in_array($id, $selectedBranches) ? 'selected' : '' }}>{{  $branch  }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('branch_id')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                        <div class="col-sm">
                            <div class="form-label"> Frota de Veículo </div>
                        <select class="form-select form-control" id="choices-model-vehicle" name="model_vehicle[]" multiple>
                            <option value="">Selecione um modelo</option>
                            @foreach ($modelVehicle as $id => $model)
                                <option value="{{ $id }}" {{ in_array($id, old('model_vehicle', $selectedModels)) ? 'selected' : '' }}>{{ $model->name }}</option>
                            @endforeach
                        </select>
                        </select>
                            @error('model_vehicle')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label mt-4">Email</label>
                                    <div class="input-group">
                                        <input id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" type="email" placeholder="example@email.com">
                                    </div>
                                    @error('email')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Email Confirmação</label>
                                    <div class="input-group">
                                        <input id="confirmation" name="confirmation" class="form-control" type="email" placeholder="example@email.com"
                                        value="{{ old('confirmation') }}">
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
                                        <input id="location" name="location" value="{{ old('location', $user->location) }}" class="form-control" type="text" placeholder="Cuiabá - MT">
                                    </div>
                                    @error('location')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Celular</label>
                                    <div class="input-group">
                                        <input id="phone" name="phone" value="{{ $user->phone }}" class="form-control" type="number" placeholder="(DDD)  + Número Telefone  ">
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
                                    <input type="text" name="cnh_number" id="cnh_number" class="form-control" value="{{ old('cnh_number', $user->cnh_number) }}">
                                </div>
                                @error('cnh_number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">Data de Vencimento da CNH</label>
                                <div class="form-group">
                                    <input type="date" name="cnh_due_date" id="cnh_due_date" class="form-control datetimepicker" value=" {{ old('cnh_due_date', $user->cnh_due_date) }}">
                                </div>
                                @error('cnh_due_date')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label class="form-label">Categoria CNH</label>
                                    <select id="choices-category" name="cnh_category" class="form-control">
                                        <option value="A" {{ old('cnh_category') == 'A' || $user->cnh_category == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('cnh_category') == 'B' || $user->cnh_category == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="AB" {{ old('cnh_category') == 'AB' || $user->cnh_category == 'AB' ? 'selected' : '' }}>AB</option>
                                        <option value="AC" {{ old('cnh_category') == 'AC' || $user->cnh_category == 'AC' ? 'selected' : '' }}>AC</option>
                                        <option value="AD" {{ old('cnh_category') == 'AD' || $user->cnh_category == 'AD' ? 'selected' : '' }}>AD</option>
                                        <option value="D" {{ old('cnh_category') == 'D' || $user->cnh_category == 'D' ? 'selected' : '' }}>D</option>
                                        <option value="E" {{ old('cnh_category') == 'E' || $user->cnh_category == 'E' ? 'selected' : '' }}>E</option>
                                        <option value="AE" {{ old('cnh_category') == 'AE' || $user->cnh_category == 'AE' ? 'selected' : '' }}>AE</option>
                                        <option value="A1" {{ old('cnh_category') == 'A1' || $user->cnh_category == 'A1' ? 'selected' : '' }}>A1</option>
                                        <option value="A2" {{ old('cnh_category') == 'A2' || $user->cnh_category == 'A2' ? 'selected' : '' }}>A2</option>
                                        <option value="B1" {{ old('cnh_category') == 'B1' || $user->cnh_category == 'B1' ? 'selected' : '' }}>B1</option>
                                        <option value="B2" {{ old('cnh_category') == 'B2' || $user->cnh_category == 'B2' ? 'selected' : '' }}>B2</option>
                                        <option value="B3" {{ old('cnh_category') == 'B3' || $user->cnh_category == 'B3' ? 'selected' : '' }}>B3</option>
                                        <option value="C1" {{ old('cnh_category') == 'C1' || $user->cnh_category == 'C1' ? 'selected' : '' }}>C1</option>
                                        <option value="C2" {{ old('cnh_category') == 'C2' || $user->cnh_category == 'C2' ? 'selected' : '' }}>C2</option>
                                        <option value="C3" {{ old('cnh_category') == 'C3' || $user->cnh_category == 'C3' ? 'selected' : '' }}>C3</option>
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

        if (document.getElementById('birthday')) {
                flatpickr('#birthday', {
                    allowInput: true,
                    dateFormat: "d/m/Y",
                    defaultDate: "{{ old('birthday', $user->birthday) }}",
                    disableMobile: true,
                }); // flatpickr
            }

            if (document.getElementById('cnh_due_date')) {
                flatpickr('#cnh_due_date', {
                    allowInput: true,
                    dateFormat: "d/m/Y",
                    defaultDate: "{{ old('cnh_due_date', $user->cnh_due_date) }}",
                    disableMobile: true,
                }); // flatpickr
            }

        if (document.getElementById('choices-role')) {
            var role = document.getElementById('choices-role');
            const example = new Choices(role);
        }

        if (document.getElementById('choices-branch')) {
            var branch = document.getElementById('choices-branch');
            const example = new Choices(branch);
        }

        if (document.getElementById('choices-category')) {
            var cnh_category = document.getElementById('choices-category');
            const example = new Choices(cnh_category);
        }

        if (document.getElementById('choices-model-vehicle')) {
            var modelVehicle = document.getElementById('choices-model-vehicle');
            const example = new Choices(modelVehicle);
        }

        function toggleDriverFields() {
        var driverFields = document.getElementById('driverFields');
        var roleId = document.getElementById('choices-role').value;
        if (roleId == 5) {
            driverFields.style.display = 'block';
        } else {
            driverFields.style.display = 'none';
        }
    }

    document.getElementById('choices-role').addEventListener('change', toggleDriverFields);
    toggleDriverFields();

    </script>
@endpush
