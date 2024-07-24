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

            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Edit Driver</h5>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('driver-edit.update', $driver->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <label class="form-label">Nome</label>
                                <div class="input-group">
                                    <input id="name" name="name" class="form-control" type="text" placeholder="name" value="{{ old('name') ?? $driver->name }}">
                                </div>
                                @error('name')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-label">CPF</label>
                                <div class="input-group">
                                    <input id="cpf" name="cpf" class="form-control" type="text" placeholder="000.000.000-00" value="{{ old('cpf') ?? $driver->cpf }}">
                                </div>
                                @error('cpf')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-label">Data Nascimento</label>
                                <div class="input-group">
                                    <input id="birth_date" name="birth_date" class="form-control" type="date" placeholder="birth_date" value="{{ old('birth_date') ?? $driver->birth_date}}">
                                </div>
                                @error('birth_date')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-label">Celular</label>
                                <div class="input-group">
                                    <input id="phone" name="phone" class="form-control" type="text" placeholder="phone" value="{{ old('phone') ?? $driver->phone}}">
                                </div>
                                @error('phone')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">


                            <div class="col-3">
                                <label class="form-label">CNH</label>
                                <div class="input-group">
                                    <input id="cnh_number" name="cnh_number" class="form-control" type="text" placeholder="" value="{{ old('cnh_number') ?? $driver->cnh_number}}">
                                </div>
                                @error('cnh_number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label class="form-label">Categoria CNH</label>
                                <div class="input-group">
                                    <select id="choices-category" name="cnh_category" class="form-control">
                                        <option value=""> Select Category</option>
                                        <option value="A" {{ old('cnh_category', $driver->cnh_category) == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('cnh_category', $driver->cnh_category) == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ old('cnh_category', $driver->cnh_category) == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="D" {{ old('cnh_category', $driver->cnh_category) == 'D' ? 'selected' : '' }}>D</option>
                                        <option value="E" {{ old('cnh_category', $driver->cnh_category) == 'E' ? 'selected' : '' }}>E</option>
                                    </select>
                                </div>
                                @error('cnh_category')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label class="form-label">Data Vencimento CNH</label>
                                <div class="input-group">
                                    <input id="cnh_due_date" name="cnh_due_date" class="form-control" type="date" value="{{ old('cnh_due_date') ?? $driver->cnh_due_date}}">
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
                                    <input id="street" name="street" class="form-control" type="text" placeholder="Street" value="{{ old('street') ?? $driver->street}}">
                                </div>
                                @error('street')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-2">
                                <label class="form-label">Numero</label>
                                <div class="input-group">
                                    <input id="number" name="number" class="form-control" type="text" placeholder="Number" value="{{ old('number') ?? $driver->number }}">
                                </div>
                                @error('number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label class="form-label">Cidade</label>
                                <div class="input-group">
                                    <input id="city" name="city" class="form-control" type="text" placeholder="City" value="{{ old('city') ?? $driver->city }}">
                                </div>
                                @error('city')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label class="form-label">Estado</label>
                                <div class="input-group">
                                    <input id="state" name="state" class="form-control" type="text" placeholder="state" value="{{ old('state')  ?? $driver->state}}">
                                </div>
                                @error('state')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="{{ old('status') ? 'active' : 'inactive' }}" {{ $driver->status == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Status</label>
                            </div>
                            @error('status')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('reservation-management') }}" class="btn btn-light m-0">Volta</a>
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
<script src="/assets/js/plugins/choices.min.js"></script>
<script>
    var birthdayArray = <?php echo !empty($birthdayArray) ? json_encode($birthdayArray) : '"0"'; ?>;
    var selectedYear = birthdayArray["year"];
    var selectedMonth = Math.floor(birthdayArray["month"]);
    var selectedDay = birthdayArray["day"];

    // if (document.getElementById('choices-gender')) {
    //     var gender = document.getElementById('choices-gender');
    //     const example = new Choices(gender);
    // }

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

    // if (document.getElementById('choices-skills')) {
    //     var skills = document.getElementById('choices-skills');
    //     const example = new Choices(skills, {
    //         removeItemButton: true,
    //     });
    // }

    

    // var openFile = function(event) {
    //     var input = event.target;
    //
    //     // Instantiate FileReader
    //     var reader = new FileReader();
    //     reader.onload = function() {
    //         imageFile = reader.result;
    //
    //         document.getElementById("imageChange").innerHTML = '<img width="200" src="' + imageFile +
    //             '" class="rounded-circle w-100 shadow" />';
    //     };
    //     reader.readAsDataURL(input.files[0]);
    // };
</script>
@endpush