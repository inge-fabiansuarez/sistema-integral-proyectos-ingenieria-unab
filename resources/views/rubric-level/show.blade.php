@extends('layouts.user_type.auth')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Nivel de Rúbrica</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rubric-levels.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $rubricLevel->name }}
                        </div>
                        <div class="form-group">
                            <strong>Puntos:</strong>
                            {{ $rubricLevel->points }}
                        </div>
                        <div class="form-group">
                            <strong>ID de Criterio de Rúbrica:</strong>
                            {{ $rubricLevel->rubric_criteria_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
