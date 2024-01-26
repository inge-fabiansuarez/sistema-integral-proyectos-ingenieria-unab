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
        <div class="page-header section-height-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">
                            @if ($errors->any())
                                <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                    <span class="alert-text text-white">
                                        {{ $errors->first() }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                    role="alert">
                                    <span class="alert-text text-white">
                                        {{ session('success') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h4 class="mb-0">Debes ingresar la contraseña del evento para poder subir el proyecto</h4>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('up-project', $event) }}" method="POST" role="form text-left">
                                    @csrf
                                    <div>
                                        <label for="password">Contraseña del Evento</label>
                                        <div class="">
                                            <input id="password" name="password" type="password" class="form-control"
                                                placeholder="Contraseña" aria-label="Contraseña"
                                                aria-describedby="password-addon">
                                            @if (isset($password) && $password != null)
                                                <p class="text-danger text-xs mt-2">{{ $password }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn bg-gradient-info w-100 mt-4 mb-0">Inscribirse</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url({{ asset('storage/' . $event->img_cover) }})"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.guest.footer')
    @endif
@endsection
