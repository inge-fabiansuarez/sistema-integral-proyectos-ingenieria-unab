@extends('layouts.app')

@section('template_title')
    {{ $rubricLevel->name ?? "{{ __('Show') Rubric Level" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Rubric Level</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rubric-levels.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $rubricLevel->name }}
                        </div>
                        <div class="form-group">
                            <strong>Points:</strong>
                            {{ $rubricLevel->points }}
                        </div>
                        <div class="form-group">
                            <strong>Rubric Criteria Id:</strong>
                            {{ $rubricLevel->rubric_criteria_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
