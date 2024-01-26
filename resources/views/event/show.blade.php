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
                    <div class="col-xl-8 col-lg-8 col-md-8 mx-auto">
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
                                    {{-- <div class="form-group">
                                        <label for="password">Contraseña:</label>
                                        <input type="password" placeholder="Contraseña" name="password" id="password"
                                            class="form-control" required>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Subir el
                                            proyecto</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Subir el proyecto <a href="javascript:;"
                                            class="text-dark font-weight-bolder">Subir el proyecto</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('layouts.footers.guest.footer')
    @endif
@endsection
