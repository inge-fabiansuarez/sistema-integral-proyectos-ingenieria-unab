@extends('layouts.user_type.auth')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Criterio de Rúbrica') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('rubric-criteria.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>ID de Rúbrica</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rubricCriteria as $rubricCriterion)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $rubricCriterion->name }}</td>
											<td>{{ $rubricCriterion->rubrics_id }}</td>

                                            <td>
                                                <form action="{{ route('rubric-criteria.destroy',$rubricCriterion->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('rubric-criteria.show',$rubricCriterion->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('rubric-criteria.edit',$rubricCriterion->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
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
                {!! $rubricCriteria->links() !!}
            </div>
        </div>
    </div>
@endsection
