@extends('layouts.user_type.auth')

@section('content')
    <div>
        {{-- <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white">
                <strong>Aqui encontraras la configuracion de los usuarios con sus roles y permisos</strong>
            </span>
        </div> --}}
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
                                <h5 class="mb-0">Roles</h5>
                            </div>
                            <div>
                                <a href="{{ route('user.roles.create') }}" class="btn bg-gradient-success btn-sm mb-0"
                                    type="button">+&nbsp; Nuevo
                                    Rol</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder">
                                            Id</th>
                                        <th
                                            class="text-uppercase text-secondary  font-weight-bolder opacity-7 ps-2">
                                            Rol</th>
                                        <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7"
                                            colspan="2">
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td class="align-middle " width="15px" >
                                                <span
                                                    class="text-secondary  font-weight-bold">{{ $role->id }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary  font-weight-bold">{{ $role->name }}</span>
                                            </td>
                                            <td width="10px" class="align-middle text-center">
                                                <a href="{{ route('user.roles.edit', $role) }}"
                                                    class="btn bnt-sm btn-info">Editar</a>
                                            </td>
                                            <td width="10px" class="align-middle text-center">
                                                <form action="{{ route('user.roles.destroy', $role) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn bnt-sm btn-danger">Eliminar</button>
                                                </form>
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
