@extends('layouts.user_type.auth')
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Projectos</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('projects.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $project->title }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $project->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
