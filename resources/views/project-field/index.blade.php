@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Proyectos de Campo
                            </span>
                             <div class="float-right">
                                <a href="{{ route('project-fields.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  Crear Nuevo
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
                                        <th>Tipo de Campo</th>
                                        <th>Orden</th> <!-- Agregado el campo Orden -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectFields as $projectField)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $projectField->name }}</td>
                                            <td>{{ \App\Enums\TypeFieldProjectEnum::from($projectField->type_field)->getName() }}</td>
                                            <td>{{ $projectField->order }}</td> <!-- Mostrar el campo Orden -->
                                            <td>
                                                <form action="{{ route('project-fields.destroy',$projectField->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('project-fields.show',$projectField->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('project-fields.edit',$projectField->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $projectFields->links() !!}
            </div>
        </div>
    </div>
@endsection
