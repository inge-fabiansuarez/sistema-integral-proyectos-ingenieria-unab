@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid">
        @if ($evaluations->count() == 0)
            <div class="card bg-gradient-default">
                <div class="card-body">
                    <blockquote class="blockquote text-white p-3">
                        <h3>No hay proyecto por evaluar!</h3>
                    </blockquote>
                </div>
            </div>
        @endif
        @foreach ($evaluations as $evaluation)
            <div class="row mb-4">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100">
                                        {{-- <p class="mb-1 pt-2 text-bold">Built by developers</p> --}}
                                        <h5 class="font-weight-bolder">
                                            {{ Illuminate\Support\Str::limit($evaluation->project->title, 100, '...') }}
                                        </h5>
                                        <p class="mb-5">
                                            {{ Illuminate\Support\Str::limit($evaluation->project->description, 500, '...') }}
                                        </p>

                                        <a target="_blank"
                                            class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                            href="{{ route('projects.show', $evaluation->project) }}">
                                            Ver proyecto
                                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                        </a>
                                        <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                            href="{{ route('rubric-evaluations.create', $evaluation) }}">
                                            Evaluar
                                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                                    <div class="bg-gradient-primary border-radius-lg h-100">
                                        <img src="../assets/img/shapes/waves-white.svg"
                                            class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                        <div
                                            class="position-relative d-flex align-items-center justify-content-center h-100">
                                            <img class="w-100 position-relative z-index-2 pt-4"
                                                src="{{ asset('storage/' . $evaluation->project->cover_image) }}"
                                                alt="rocket">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
        {{--  <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Rubric Evaluation') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('rubric-evaluations.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Projects Id</th>
                                        <th>Evaluador Id</th>
                                        <th>Rubric Criteria Id</th>
                                        <th>Rubric Levels Selected Id</th>
                                        <th>Comments</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rubricEvaluations as $rubricEvaluation)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $rubricEvaluation->projects_id }}</td>
                                            <td>{{ $rubricEvaluation->evaluador_id }}</td>
                                            <td>{{ $rubricEvaluation->rubric_criteria_id }}</td>
                                            <td>{{ $rubricEvaluation->rubric_levels_selected_id }}</td>
                                            <td>{{ $rubricEvaluation->comments }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('rubric-evaluations.destroy', $rubricEvaluation->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('rubric-evaluations.show', $rubricEvaluation->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('rubric-evaluations.edit', $rubricEvaluation->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $rubricEvaluations->links() !!}
            </div>
        </div> --}}
    </div>
@endsection
