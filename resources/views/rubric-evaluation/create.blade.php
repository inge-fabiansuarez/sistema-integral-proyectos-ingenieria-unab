@extends('layouts.user_type.auth')

@section('content')
    <section class="content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card bg-gradient-default">
                    <div class="card-body">
                        <h3 class="card-title text-info text-gradient">Rúbica</h3>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    {{ $project->title }}
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    {{ $project->description }}
                                </p>
                            </div>
                            <a target="_blank" style="color: red;"
                                class=" text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                href="{{ route('projects.show', $project) }}">
                                Ver todo el proyecto
                                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                        <br>
                        <blockquote class="blockquote text-white p-3">

                            @if (App\Enums\StateEvaluationUserEnum::EVALUATED->getId() == $projectsHasEvaluator->state_evaluation)
                                <h3>Ya fue evaluadó el proyecto</h3>
                                @if ($rubricEvaluations != null)
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Criterio</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Nivel</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Puntuación</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Evaluador</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Comentarios</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($rubricEvaluations as $evaluation)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    {{-- <div>
                                                                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg"
                                                                            class="avatar avatar-sm me-3">
                                                                    </div> --}}
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-xs">
                                                                            {{ $evaluation->rubricCriterion->name }}</h6>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $evaluation->rubricLevel->name }}</p>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <p class="text-s font-weight-bold mb-0">
                                                                    {{ $evaluation->rubricLevel->points }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $evaluation->evaluator->name }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $evaluation->comments }}</p>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <form action="{{ route('rubric-evaluations.store', $projectsHasEvaluator) }}"
                                    method="POST">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert p-2 text-xs alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @foreach ($rubric->rubricCriterias as $criteria)
                                        <div class="form-group">
                                            <label for="example-text-input"
                                                class="form-control-label">{{ $criteria->name }}</label>
                                            @foreach ($criteria->rubricLevels as $level)
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio"
                                                        name="criteria_{{ $criteria->id }}" value="{{ $level->id }}"
                                                        id="criteria_{{ $criteria->id }}">
                                                    <label class="custom-control-label"
                                                        for="criteria_{{ $criteria->id }}">{{ $level->name }} -
                                                        {{ $level->points }} puntos</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                    <button type="submit" class="btn btn-success">Enviar Evaluación</button>
                                </form>
                            @endif

                        </blockquote>
                    </div>
                </div>


                @includeif('partials.errors')

                {{-- <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Rubric Evaluation</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rubric-evaluations.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                             @include('rubric-evaluation.form')

                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection
