@extends('layouts.user_type.auth')

@section('content')
    <section class="min-vh-100 mb-5">
        <div class="page-header align-items-start min-vh-50 pt-2 pb-4 mx-3 border-radius-lg"
            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>

        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-10 col-lg-10 col-md-10 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Nuevo Empleado</h5>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" method="POST" action="{{ route('user.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Nombre" name="name"
                                        id="name" aria-label="Name" aria-describedby="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        id="email" aria-label="Email" aria-describedby="email-addon"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        id="password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input  class="form-control" placeholder="Telefono" name="phone"
                                        id="phone" aria-label="Name" aria-describedby="phone" type="number"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Perfil" name="about_me"
                                        id="location" aria-label="Name" aria-describedby="about_me"
                                        value="{{ old('about_me') }}">
                                    @error('about_me')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Ubicación" name="location"
                                        id="location" aria-label="Name" aria-describedby="location"
                                        value="{{ old('location') }}">
                                    @error('location')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-check form-check-info text-left">
                                    <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault"
                                        checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Se acepta los <a href="javascript:;" class="text-dark font-weight-bolder">Términos y
                                            condiciones</a>
                                    </label>
                                    @error('agreement')
                                        <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try
                                            register again.</p>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-success w-100 my-4 mb-2">Crear Empleado</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
