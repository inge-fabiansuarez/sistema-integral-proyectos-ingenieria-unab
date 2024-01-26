@extends('layouts.user_type.auth')
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalle de Campo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('project-fields.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>{{ __('Name') }}:</strong>
                            {{ $projectField->name }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Type Field') }}:</strong>
                            {{ \App\Enums\TypeFieldProjectEnum::from($projectField->type_field)->getName() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
