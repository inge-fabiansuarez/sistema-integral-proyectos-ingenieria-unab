@extends('layouts.user_type.auth')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Rubric Evaluation</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rubric-evaluations.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Projects Id:</strong>
                            {{ $rubricEvaluation->projects_id }}
                        </div>
                        <div class="form-group">
                            <strong>Evaluador Id:</strong>
                            {{ $rubricEvaluation->evaluador_id }}
                        </div>
                        <div class="form-group">
                            <strong>Rubric Criteria Id:</strong>
                            {{ $rubricEvaluation->rubric_criteria_id }}
                        </div>
                        <div class="form-group">
                            <strong>Rubric Levels Selected Id:</strong>
                            {{ $rubricEvaluation->rubric_levels_selected_id }}
                        </div>
                        <div class="form-group">
                            <strong>Comments:</strong>
                            {{ $rubricEvaluation->comments }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
