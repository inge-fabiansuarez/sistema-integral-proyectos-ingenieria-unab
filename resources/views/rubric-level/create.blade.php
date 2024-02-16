@extends('layouts.user_type.auth')
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Nivel de Rúbrica</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rubric-levels.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('rubric-level.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
