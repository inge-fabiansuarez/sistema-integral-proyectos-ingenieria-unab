@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Rubric Criterion
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Rubric Criterion</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rubric-criteria.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('rubric-criterion.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
