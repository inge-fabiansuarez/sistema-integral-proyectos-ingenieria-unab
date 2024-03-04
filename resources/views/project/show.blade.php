@extends('layouts.user_type.auth')
@section('content')
    <section class="content container-fluid">

        <div class="container-fluid">
            <div class="page-header min-height-100 border-radius-xl mt-4"
                style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <i class="fas fa-project-diagram fa-3x text-primary"></i>
                        </div>
                    </div>


                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $project->title }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ $project->description }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                <li class="nav-item">
                                    {{--  <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('projects.index') }}">
                                            {{ __('Atras') }}</a>
                                    </div> --}}

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row justify-content-center align-items-center ">
                <div class="col-12 col-xl-9 m-2">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Resumen</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm">
                                {{ $project->description }}
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-9 m-2">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Palabras clave</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-unstyled">
                                @foreach ($project->keywords as $keyword)
                                    <li>{{ $keyword->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @foreach ($project->projectFields as $field)
                    <div class="col-12 col-xl-9 m-2">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">{{ $field->name }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                @switch(App\Enums\TypeFieldProjectEnum::from($field->type_field)->getId())
                                    @case(App\Enums\TypeFieldProjectEnum::TEXT->getId())
                                        <p class="text-sm">
                                            {{ $field->pivot->value }}
                                        </p>
                                    @break

                                    @case(App\Enums\TypeFieldProjectEnum::FILE->getId())
                                        <a style="color: red" href="{{ asset( $field->pivot->value) }}" target="_blank">
                                            <i class="fas fa-download"></i> Descargar archivo
                                        </a>
                                    @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </section>
@endsection
