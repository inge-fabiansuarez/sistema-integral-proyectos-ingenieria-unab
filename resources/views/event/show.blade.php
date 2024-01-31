@extends('layouts.app')

@section('auth-or-guest')
    @if (\Request::is('login/forgot-password'))
        @include('layouts.navbars.guest.nav')
        @yield('content')
    @else
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    @include('layouts.navbars.guest.nav')
                </div>
            </div>
        </div>
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
                style="background-image: url('{{ asset('storage/' . $event->img_cover) }}');">
                <span class="mask bg-gradient-dark opacity-4"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">{{ $event->name }}</h1>
                            <p class="text-lead text-white">Bienvenido al evento, por medio de este formulario subirás el
                                proyecto.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>{{ $event->createdBy->name }}</h5>
                                <h6>{{ $event->createdBy->about_me }}</h6>
                            </div>

                            <div class="card-body">
                                <form role="form text-left" method="POST" action="{{ route('up-project', $event) }}">
                                    @csrf
                                    <div class="form-group">
                                        <strong>Nombre:</strong>
                                        {{ $event->name }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Fecha de Apertura:</strong>
                                        {{ $event->opening_date }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Fecha de Cierre:</strong>
                                        {{ $event->closing_date }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Descripción:</strong>
                                        {{ $event->description }}
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Subir el
                                            proyecto</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="card mb-4">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-1">Proyectos</h6>
                                    <p class="text-sm">Proyectos subidos</p>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6  mb-4">
                                            <div class="card card-blog card-plain">
                                                <div class="position-relative">
                                                    <a class="d-block shadow-xl border-radius-xl">
                                                        <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow"
                                                            class="img-fluid shadow border-radius-xl">
                                                    </a>
                                                </div>
                                                <div class="card-body px-1 pb-0">
                                                    <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                                                    <a href="javascript:;">
                                                        <h5>
                                                            Modern
                                                        </h5>
                                                    </a>
                                                    <p class="mb-4 text-sm">
                                                        As Uber works through a huge amount of internal management turmoil.
                                                    </p>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <button type="button"
                                                            class="btn btn-outline-primary btn-sm mb-0">View
                                                            Project</button>
                                                        <div class="avatar-group mt-2">
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Elena Morison">
                                                                <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Ryan Milly">
                                                                <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Nick Daniel">
                                                                <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Peterson">
                                                                <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6  mb-4">
                                            <div class="card card-blog card-plain">
                                                <div class="position-relative">
                                                    <a class="d-block shadow-xl border-radius-xl">
                                                        <img src="../assets/img/home-decor-2.jpg" alt="img-blur-shadow"
                                                            class="img-fluid shadow border-radius-lg">
                                                    </a>
                                                </div>
                                                <div class="card-body px-1 pb-0">
                                                    <p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
                                                    <a href="javascript:;">
                                                        <h5>
                                                            Scandinavian
                                                        </h5>
                                                    </a>
                                                    <p class="mb-4 text-sm">
                                                        Music is something that every person has his or her own specific
                                                        opinion about.
                                                    </p>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <button type="button"
                                                            class="btn btn-outline-primary btn-sm mb-0">View
                                                            Project</button>
                                                        <div class="avatar-group mt-2">
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Nick Daniel">
                                                                <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Peterson">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-4.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Elena Morison">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-1.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Ryan Milly">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-2.jpg">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card card-blog card-plain">
                                                <div class="position-relative">
                                                    <a class="d-block shadow-xl border-radius-xl">
                                                        <img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow"
                                                            class="img-fluid shadow border-radius-xl">
                                                    </a>
                                                </div>
                                                <div class="card-body px-1 pb-0">
                                                    <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                                                    <a href="javascript:;">
                                                        <h5>
                                                            Minimalist
                                                        </h5>
                                                    </a>
                                                    <p class="mb-4 text-sm">
                                                        Different people have different taste, and various types of music.
                                                    </p>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <button type="button"
                                                            class="btn btn-outline-primary btn-sm mb-0">View
                                                            Project</button>
                                                        <div class="avatar-group mt-2">
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Peterson">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-4.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Nick Daniel">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-3.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Ryan Milly">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-2.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Elena Morison">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-1.jpg">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card card-blog card-plain">
                                                <div class="position-relative">
                                                    <a class="d-block shadow-xl border-radius-xl">
                                                        <img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow"
                                                            class="img-fluid shadow border-radius-xl">
                                                    </a>
                                                </div>
                                                <div class="card-body px-1 pb-0">
                                                    <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                                                    <a href="javascript:;">
                                                        <h5>
                                                            Minimalist
                                                        </h5>
                                                    </a>
                                                    <p class="mb-4 text-sm">
                                                        Different people have different taste, and various types of music.
                                                    </p>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <button type="button"
                                                            class="btn btn-outline-primary btn-sm mb-0">View
                                                            Project</button>
                                                        <div class="avatar-group mt-2">
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Peterson">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-4.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Nick Daniel">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-3.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Ryan Milly">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-2.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Elena Morison">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-1.jpg">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card card-blog card-plain">
                                                <div class="position-relative">
                                                    <a class="d-block shadow-xl border-radius-xl">
                                                        <img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow"
                                                            class="img-fluid shadow border-radius-xl">
                                                    </a>
                                                </div>
                                                <div class="card-body px-1 pb-0">
                                                    <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                                                    <a href="javascript:;">
                                                        <h5>
                                                            Minimalist
                                                        </h5>
                                                    </a>
                                                    <p class="mb-4 text-sm">
                                                        Different people have different taste, and various types of music.
                                                    </p>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <button type="button"
                                                            class="btn btn-outline-primary btn-sm mb-0">View
                                                            Project</button>
                                                        <div class="avatar-group mt-2">
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Peterson">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-4.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Nick Daniel">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-3.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Ryan Milly">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-2.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Elena Morison">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/team-1.jpg">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card h-100 card-plain border">
                                                <div
                                                    class="card-body d-flex flex-column justify-content-center text-center">
                                                    <a href="javascript:;">
                                                        <i class="fa fa-plus text-secondary mb-3"></i>
                                                        <h5 class=" text-secondary"> New project </h5>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
