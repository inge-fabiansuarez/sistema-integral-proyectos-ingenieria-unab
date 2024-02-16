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
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h4 class="font-weight-bold">Criterios de la rubrica</h4>
                            <div class="float-right">
                                <a href="{{ route('rubric-criteria.create', $rubric) }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Crear Nuevo') }} Criterio a esta rubrica
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($rubric->rubricCriterias as $criterion)
                            <div class="mb-4">
                                <h4 class="font-weight-bold">{{ $loop->iteration }}. {{ $criterion->name }}</h4>
                                <ul class="list-group">
                                    @foreach ($criterion->rubricLevels as $level)
                                        <li class="list-group-item">{{ $level->name }} - {{ $level->points }}</li>
                                    @endforeach
                                    <li class="list-group-item">
                                        <form method="POST" action="{{ route('rubric-levels.store') }}" role="form"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @include('rubric-level.form')
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
