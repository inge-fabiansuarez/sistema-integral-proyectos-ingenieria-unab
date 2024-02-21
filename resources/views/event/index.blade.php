@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Evento') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Crear Nuevo') }}
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
                                        <th>Nombre</th>
                                        <th>Fecha de Apertura</th>
                                        <th>Fecha de Cierre</th>
                                        <th>Creado Por</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->opening_date }}</td>
                                            <td>{{ $event->closing_date }}</td>
                                            <td>{{ $event->createdBy->name }}</td>
                                            <td>
                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('events.showBySlug', $event->slug) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('events.edit', $event->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('events.indexevaluation', $event->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i>
                                                        {{ __('Asignar Evaluación') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $events->links() !!}
            </div>
        </div>
    </div>
@endsection
