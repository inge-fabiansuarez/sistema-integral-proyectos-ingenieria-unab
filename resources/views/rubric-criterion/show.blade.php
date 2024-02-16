@extends('layouts.app')

@section('template_title')
    {{ $rubricCriterion->name ?? "{{ __('Show') Rubric Criterion" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Rubric Criterion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rubric-criteria.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $rubricCriterion->name }}
                        </div>
                        <div class="form-group">
                            <strong>Rubrics Id:</strong>
                            {{ $rubricCriterion->rubrics_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
