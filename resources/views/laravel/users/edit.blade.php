@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl ">
        <div class="container-fluid py-1 px-3">
            @include('layouts.navbars.auth.topnav', ['title' => 'Edit User'])
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
                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="../../../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 "
                                                alt="user image">
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
                                            <img src="/assets/img/small-logos/logo-spotify.svg"
                                                class="avatar avatar-sm bg-gradient-dark  me-3 " alt="logo spotify">
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
                                            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>credit-card</title>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                        fill-rule="nonzero">
                                                        <g transform="translate(1716.000000, 291.000000)">
                                                            <g transform="translate(453.000000, 454.000000)">
                                                                <path class="color-background"
                                                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                    opacity="0.593633743"></path>
                                                                <path class="color-background"
                                                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
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
                        <h5>Edit User</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form method="POST" action="{{ route('user-edit.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label class="form-label">First Name</label>
                                    <div class="input-group">
                                        <input id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" class="form-control" type="text" placeholder="Firstname" >
                                    </div>
                                    @error('firstname')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <div class="input-group">
                                        <input id="lastname" name="lastname" value="{{ old('lastname') ?? $user->lastname }}" class="form-control" type="text" placeholder="Lastname">
                                    </div>
                                </div>
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
                                <label class="form-label">Birth Date</label>
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
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input id="password" name="password" class="form-control" type="password" placeholder="Password">
                                    </div>
                                    @error('password')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input id="confirm-password" name="confirm-password" class="form-control" type="password" placeholder="Confirm Password">
                                    </div>
                                    @error('confirm-password')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm">
                                    <label class="form-label">Role</label>
                                    <select name="role" id="choices-role" class="form-control">
                                        <option value="">Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->id == old('role', $user->role_id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <label class="form-label">Branch</label>
                                    <select name="branch" id="choices-branch" class="form-control">
                                        <option value="">Branch</option>
                                        @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ $branch->id == old('branch', $user->branch_id) ? 'selected' : '' }}>{{ $branch->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('branch')
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
                                    <label class="form-label mt-4">Confirmation Email</label>
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
                                    <label class="form-label mt-4">Location</label>
                                    <div class="input-group">
                                        <input id="location" name="location" value="{{ old('location') ?? $user->location }}" class="form-control" type="text" placeholder="Sydney, A">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Phone Number</label>
                                    <div class="input-group">
                                        <input id="phone" name="phone" value="{{ $user->phone }}" class="form-control" type="number" placeholder="+40 735 631 620">
                                    </div>
                                    @error('phone')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('user-management') }}" class="btn btn-light m-0">Back</a>
                                <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Save</button>
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

        if (document.querySelector('.datetimepicker')) {
                flatpickr('.datetimepicker', {
                    allowInput: true,
                    dateFormat: "d/m/Y",
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

    </script>
@endpush
