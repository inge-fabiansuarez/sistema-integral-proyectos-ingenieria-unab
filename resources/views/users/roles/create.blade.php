@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white">
                <strong>Aqui encontraras la configuracion de los usuarios con sus roles y permisos</strong>
            </span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Crear un nuevo Rol</h5>
                            </div>
                            <div>
                                <a href="{{ route('user.roles.index') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                    type="button">Regresar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form method="POST" action="{{ route('user.roles.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nombre</label>
                                <input name="name" placeholder="Ingrese el nombre del rol" class="form-control"
                                    type="text" id="example-text-input">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Lista de permisos</label>

                                @foreach ($permissions as $permission)
                                    <div class="form-check form-switch">
                                        <input name="permissions[]" value="{{ $permission->id }}" class="form-check-input"
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"
                                            for="flexSwitchCheckDefault">{{ $permission->description }}</label>

                                    </div>
                                @endforeach
                            </div>


                            <button class="btn bg-gradient-success btn-sm mb-0" type="submit">+&nbsp; Crear
                                Rol</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
