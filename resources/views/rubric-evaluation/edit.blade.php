@extends('layouts.user_type.auth')

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Rubric Evaluation</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rubric-evaluations.update', $rubricEvaluation->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('rubric-evaluation.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
