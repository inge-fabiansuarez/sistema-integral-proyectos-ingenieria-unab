@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-header text-center pt-4">
                        <h5>{{ $event->name }}</h5>
                        <span
                            class="badge badge-pill badge-lg bg-gradient-success">{{ App\Enums\StateEventEnum::from($event->state)->getName() }}</span>
                    </div>

                    <div class="card-body">
                        <form role="form text-left" method="POST" action="{{ route('up-project', $event) }}">
                            @csrf
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                {{ $event->name }}
                            </div>
                            <div class="form-group">
                                <strong>Fecha de Apertura:</strong>
                                {{ $event->opening_date }}
                            </div>
                            <div class="form-group">
                                <strong>Fecha de Cierre:</strong>
                                {{ $event->closing_date }}
                            </div>
                            <div class="form-group">
                                <strong>Descripción:</strong>
                                {{ $event->description }}
                            </div>
                            <div class="form-group">
                                <strong>Evento elaborado por:</strong>
                                {{ $event->createdBy->name }}
                            </div>

                        </form>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block bg-gradient-danger mb-3" data-bs-toggle="modal"
                                data-bs-target="#modal-notification">Cerrar Evento</button>
                            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog"
                                aria-labelledby="modal-notification" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-notification">Su atención es requerida
                                            </h6>
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="py-3 text-center">
                                                <i class="ni ni-bell-55 ni-3x"></i>
                                                <h4 class="text-gradient text-danger mt-4">Se va a cerrar el evento y no
                                                    recibiras más proyectos!</h4>
                                                {{-- <p>A small river named Duden flows by their place and supplies it with the
                                                    necessary regelialia.</p> --}}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger">Ok, Cerrar</button>
                                            <button type="button" class="btn btn-link ml-auto"
                                                data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Projects</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">{{ $event->projects()->count() }} subidos</span>
                                </p>
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-secondary" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Asignar
                                                evaluadores</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Proyecto</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Miembros</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Evaluadores</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->projects as $project)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('storage/' . $project->cover_image) }}"
                                                            class="avatar avatar-sm me-3" alt="xd">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm w-100"
                                                            style="word-wrap: break-word; overflow: visible;">
                                                            {{ Illuminate\Support\Str::limit($project->title, 80, '...') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group mt-2">
                                                    @foreach ($project->projectAuthors as $projectAuthor)
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            aria-label="{{ $projectAuthor->user->name }}"
                                                            data-bs-original-title="{{ $projectAuthor->user->name }}">
                                                            <img
                                                                src="{{ asset('storage/' . $projectAuthor->user->profile_image) }}">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group mt-2">
                                                    @foreach ($project->evaluators as $projectEvaluator)
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            aria-label="{{ $projectEvaluator->name }}"
                                                            data-bs-original-title="{{ $projectEvaluator->name }}">
                                                            <img
                                                                src="{{ asset('storage/' . $projectEvaluator->profile_image) }}">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="dropdown">
                                                    <button class="btn bg-gradient-success dropdown-toggle btn-sm"
                                                        type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Acciones
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('projects.show', $project) }}">Ver
                                                                proyecto</a>
                                                        </li>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn bg-gradient-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#a{{ $project->id }}">
                                                            Asignar Evaluadores
                                                        </button>


                                                        </li>

                                                    </ul>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="a{{ $project->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Asignar Evaluadores</h5>
                                                                    <button type="button" class="btn-close text-dark"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <form
                                                                    action="{{ route('events.setUserEvaluation', $project) }}"
                                                                    method="post">
                                                                    <input type="hidden" name="eventId"
                                                                        value="{{ $event->id }}">
                                                                    <div class="modal-body">
                                                                        Id Projecto: {{ $project->id }}
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleFormControlSelect2">Seleccione
                                                                                los evaluadores</label>
                                                                            <select multiple class="form-control"
                                                                                id="exampleFormControlSelect2"
                                                                                name="evaluators[]">
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id }}"
                                                                                        @if ($user->id == $project->evaluators->contains('id', $user->id)) @selected(true) @endif>
                                                                                        {{ $user->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn bg-gradient-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn bg-gradient-primary">Asignar los
                                                                            evaluadores</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
