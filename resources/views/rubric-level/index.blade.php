@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Nivel de Rúbrica') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('rubric-levels.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Puntos</th>
										<th>ID de Criterio de Rúbrica</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rubricLevels as $rubricLevel)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $rubricLevel->name }}</td>
											<td>{{ $rubricLevel->points }}</td>
											<td>{{ $rubricLevel->rubric_criteria_id }}</td>

                                            <td>
                                                <form action="{{ route('rubric-levels.destroy',$rubricLevel->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('rubric-levels.show',$rubricLevel->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('rubric-levels.edit',$rubricLevel->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $rubricLevels->links() !!}
            </div>
        </div>
    </div>
@endsection
