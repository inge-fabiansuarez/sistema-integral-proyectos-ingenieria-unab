@extends('layouts.user_type.auth')

@section('content')
    <div>

        @if (session('msg'))
            <div class="alert alert-{{ session('msg.class') }} mb-4 mx-4">
                {{ session('msg.body') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Editar Rol</h5>
                            </div>
                            <div>
                                <a href="{{ route('user.roles.index') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                    type="button">Regresar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form method="POST" action="{{ route('user.roles.update', $role) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nombre</label>
                                <input name="name" placeholder="Ingrese el nombre del rol" class="form-control"
                                    type="text" id="example-text-input" value="{{ $role->name }}">
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
                                            type="checkbox" id="flexSwitchCheckDefault"
                                            @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                        <label class="form-check-label"
                                            for="flexSwitchCheckDefault">{{ $permission->description }}</label>

                                    </div>
                                @endforeach
                            </div>
                            <button class="btn bg-gradient-info btn-sm mb-0" type="submit">+&nbsp; Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
