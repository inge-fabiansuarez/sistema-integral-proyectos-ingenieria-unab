@extends('layouts.user_type.auth')

@section('content')
    <section class="content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card bg-gradient-default">
                    <div class="card-body">
                        <h3 class="card-title text-info text-gradient">Evaluadores</h3>
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


                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Evaluador</th>

                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Estado Evaluación</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Total Calificación</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projectHasEvaluator as $evaluatorAssignment)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                @if (!$evaluatorAssignment->evaluator->profile_image)
                                                                    <img src="{{ asset('assets/docs-default/user.png') }}"
                                                                        class="avatar avatar-sm me-3">
                                                                @else
                                                                    <img src="{{ asset('storage/' . $evaluatorAssignment->evaluator->profile_image) }}"
                                                                        class="avatar avatar-sm me-3">
                                                                @endif

                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">
                                                                    {{ $evaluatorAssignment->evaluator->name }}</h6>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ $evaluatorAssignment->evaluator->email }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="align-middle text-center">

                                                        @switch($evaluatorAssignment->state_evaluation)
                                                            @case(App\Enums\StateEvaluationUserEnum::ASSIGNED->getId())
                                                                <span class="badge bg-gradient-danger">SIN EVALUACION</span>
                                                            @break

                                                            @case(App\Enums\StateEvaluationUserEnum::EVALUATED->getId())
                                                                <span class="badge bg-gradient-success">EVALUADO</span>
                                                            @break

                                                            @default
                                                        @endswitch


                                                    </td>
                                                    <td>

                                                        @switch($evaluatorAssignment->state_evaluation)
                                                            @case(App\Enums\StateEvaluationUserEnum::ASSIGNED->getId())
                                                                <p class="text text-secondary mb-0">Sin evaluación</p>
                                                            @break

                                                            @case(App\Enums\StateEvaluationUserEnum::EVALUATED->getId())
                                                                <p class="text text-secondary mb-0">
                                                                    {{ $evaluatorAssignment->getTotalEvaluationPoints($evaluatorAssignment->evaluator) }}
                                                                </p>
                                                            @break

                                                            @default
                                                        @endswitch

                                                    </td>
                                                    <td class="align-middle">

                                                        @switch($evaluatorAssignment->state_evaluation)
                                                            @case(App\Enums\StateEvaluationUserEnum::ASSIGNED->getId())
                                                            @break

                                                            @case(App\Enums\StateEvaluationUserEnum::EVALUATED->getId())
                                                                <a href="{{ route('rubric-evaluations.show', ['evaluator' => $evaluatorAssignment->evaluator, 'project' => $project]) }}"
                                                                    class="text-secondary font-weight-bold text-xs text-success"
                                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                                    Ver evaluación
                                                                </a>
                                                            @break

                                                            @default
                                                        @endswitch


                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </blockquote>
                    </div>
                </div>


                @includeif('partials.errors')


            </div>
        </div>
    </section>
@endsection
