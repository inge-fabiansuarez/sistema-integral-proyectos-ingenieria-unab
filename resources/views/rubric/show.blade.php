@extends('layouts.user_type.auth')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">RUBRICA</h4>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rubrics.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                        <a class="btn btn-sm btn-success"
                                                        href="{{ route('rubrics.edit', $rubric->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Nombre:</strong> {{ $rubric->name }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción:</strong> {{ $rubric->description }}
                        </div>
                        <div class="form-group">
                            <strong>Puntuación Total:</strong> {{ $rubric->total_rating }}
                        </div>
                        <div class="form-group">
                            <strong>Criterios de evaluación:</strong>
                        </div>

                        <div class="container">
                            @foreach ($rubric->rubricCriterias as $criterion)
                                <div class="row g-0">

                                    <div class="h-100 col-md-3">
                                        <div class="p-3 bg-success text-white position-relative">
                                            {{ $loop->iteration }}.
                                            {{ $criterion->name }}

                                            <form action="{{ route('rubric-criteria.destroy', $criterion->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger p-2 btn-circle position-absolute top-0 end-0"> <i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>


                                        </div>
                                    </div>

                                    <div class="h-100 col-md-8">
                                        <div class="row g-0">
                                            @foreach ($criterion->rubricLevels as $level)
                                                <div class="h-100 col">
                                                    <div class="p-3 bg-secondary text-white position-relative">
                                                        {{ $level->name }} <br>
                                                        {{ $level->points }} Puntos

                                                        <form action="{{ route('rubric-levels.destroy', $level->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger p-2 btn-circle position-absolute top-0 end-0"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                        {{-- <button
                                                            class="btn btn-danger p-2 btn-circle position-absolute top-0 end-0">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button> --}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <form method="POST" action="{{ route('rubric-levels.store') }}" role="form"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @include('rubric-level.form')
                                        </form>
                                    </div>


                                </div>
                            @endforeach


                        </div>

                        <a href="{{ route('rubric-criteria.create', $rubric) }}" class="btn btn-success btn-sm float-right"
                            data-placement="left">
                            {{ __('Crear Nuevo') }} Criterio a esta rubrica
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
