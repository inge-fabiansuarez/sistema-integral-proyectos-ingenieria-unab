<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    {{ str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ env('APP_NAME') }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <div class="nav-item d-flex align-self-end">
                <a href="#" class="btn btn-primary active mb-0 text-white" role="button" aria-pressed="true">
                    Subir Proyecto
                </a>
            </div>
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
                {{-- <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div> --}}
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ url('/logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <span class="d-sm-inline d-none">Cerrar Sesión</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    {{-- <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>

                </a> --}}
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (auth()->check() && auth()->user()->profile_image)
                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Photo"
                                class="avatar avatar-sm me-1">
                        @else
                            <i class="fa fa-user me-sm-1"></i>
                        @endif
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('userprofil.index') }}">
                                <div class="d-flex py-1">
                                    @if (auth()->check() && auth()->user()->profile_image)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                            alt="Profile Photo" class="avatar avatar-sm me-3">
                                    @else
                                        <div class="my-auto">
                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    @endif
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Perfil</span>
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>

                                            @if (auth()->check() && auth()->user()->name)
                                                {{ auth()->user()->name }}
                                            @else
                                                Ver Perfil
                                            @endif
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
<!-- End Navbar -->
