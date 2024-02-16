@extends('layouts.user_type.auth')
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Criterio de Rúbrica</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rubric-criteria.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $rubricCriterion->name }}
                        </div>
                        <div class="form-group">
                            <strong>ID de Rúbrica:</strong>
                            {{ $rubricCriterion->rubrics_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
