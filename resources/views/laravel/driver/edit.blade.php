@extends('layouts.app')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl ">
    <div class="container-fluid py-1 px-3">
        @include('layouts.navbars.auth.topnav', ['title' => 'Edit Driver'])
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
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                <li class="nav-item position-relative pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../../../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 " alt="user image">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New message</span> from Laur
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 " alt="logo spotify">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New album</span> by Travis Scott
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            1 day
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>credit-card</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(453.000000, 454.000000)">
                                                            <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                                            <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            Payment successfully completed
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            2 days
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
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
                                <label class="form-label">Name</label>
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
                                <label class="form-label">Birth Date</label>
                                <div class="input-group">
                                    <input id="birth_date" name="birth_date" class="form-control" type="date" placeholder="birth_date" value="{{ old('birth_date') ?? $driver->birth_date}}">
                                </div>
                                @error('birth_date')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-label">Phone</label>
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
                                <label class="form-label">Category CNH</label>
                                <div class="input-group">
                                    <select id="cnh_category" name="cnh_category" class="form-control">
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
                                <label class="form-label">CNH Date Due</label>
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
                                <label class="form-label">Street</label>
                                <div class="input-group">
                                    <input id="street" name="street" class="form-control" type="text" placeholder="Street" value="{{ old('street') ?? $driver->street}}">
                                </div>
                                @error('street')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-2">
                                <label class="form-label">Number</label>
                                <div class="input-group">
                                    <input id="number" name="number" class="form-control" type="text" placeholder="Number" value="{{ old('number') ?? $driver->number }}">
                                </div>
                                @error('number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label class="form-label">City</label>
                                <div class="input-group">
                                    <input id="city" name="city" class="form-control" type="text" placeholder="City" value="{{ old('city') ?? $driver->city }}">
                                </div>
                                @error('city')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label class="form-label">State</label>
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
                            <a href="{{ route('reservation-management') }}" class="btn btn-light m-0">Back</a>
                            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- @include('layouts.footers.auth.footer') -->')
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

    // if (document.getElementById('choices-language')) {
    //     var language = document.getElementById('choices-language');
    //     const example = new Choices(language);
    // }

    // if (document.getElementById('choices-skills')) {
    //     var skills = document.getElementById('choices-skills');
    //     const example = new Choices(skills, {
    //         removeItemButton: true,
    //     });
    // }

    if (document.getElementById('choices-year')) {
        var year = document.getElementById('choices-year');
        setTimeout(function() {
            const example = new Choices(year);
        }, 1);

        for (y = 1900; y <= 2020; y++) {
            var optn = document.createElement("OPTION");
            optn.text = y;
            optn.value = y;
            if (selectedYear > 0) {
                if (y == selectedYear) {
                    optn.selected = true;
                }
            }

            year.options.add(optn);
        }
    }

    if (document.getElementById('choices-day')) {
        var day = document.getElementById('choices-day');
        setTimeout(function() {
            const example = new Choices(day);
        }, 1);


        for (y = 1; y <= 31; y++) {
            var optn = document.createElement("OPTION");
            optn.text = y;
            optn.value = y;

            if (selectedDay > 0) {
                if (y == selectedDay) {
                    optn.selected = true;
                }
            }

            day.options.add(optn);
        }

    }

    if (document.getElementById('choices-month')) {
        var month = document.getElementById('choices-month');
        setTimeout(function() {
            const example = new Choices(month);
        }, 1);

        var d = new Date();
        var monthArray = new Array();
        monthArray[0] = "January";
        monthArray[1] = "February";
        monthArray[2] = "March";
        monthArray[3] = "April";
        monthArray[4] = "May";
        monthArray[5] = "June";
        monthArray[6] = "July";
        monthArray[7] = "August";
        monthArray[8] = "September";
        monthArray[9] = "October";
        monthArray[10] = "November";
        monthArray[11] = "December";
        for (m = 0; m <= 11; m++) {
            var optn = document.createElement("OPTION");
            optn.text = monthArray[m];
            // server side month start from one
            optn.value = (m + 1);
            // if june selected
            if (selectedMonth > 0) {
                if (optn.value == selectedMonth) {
                    optn.selected = true;
                }
            }
            month.options.add(optn);
        }
    }

    function visible() {
        var elem = document.getElementById('profileVisibility');
        if (elem) {
            if (elem.innerHTML == "Switch to visible") {
                elem.innerHTML = "Switch to invisible"
            } else {
                elem.innerHTML = "Switch to visible"
            }
        }
    }

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