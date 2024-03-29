@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Rúbrica') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('rubrics.create') }}" class="btn btn-primary btn-sm float-right"
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
                                        <th>Descripción</th>
                                        <th>Puntuación Total</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rubrics as $rubric)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $rubric->name }}</td>
                                            <td>{{ $rubric->description }}</td>
                                            <td>{{ $rubric->total_rating }}</td>

                                            <td>
                                                <form action="{{ route('rubrics.destroy', $rubric->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('rubrics.show', $rubric->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>

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
                {!! $rubrics->links() !!}
            </div>
        </div>
    </div>
@endsection
