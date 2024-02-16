@extends('layouts.user_type.auth')

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} Criterio de Rúbrica</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rubric-criteria.update', $rubricCriterion->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('rubric-criterion.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
