<?php

namespace App\Http\Livewire\Users;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make('Rol')
                ->label(
                    function ($row, Column $column) {
                        //$route =  route('admin.preoperacional.moto.imprimir.descargar', $row);
                        $linea = "";
                        foreach ($row->getRoleNames() as $roleName) {
                            $linea .= $roleName;
                        }
                        echo $linea;
                    }
                )
                ->html(),
            Column::make("Nombre", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Telefono", "phone")
                ->sortable(),
            Column::make("Dirección", "location")
                ->sortable(),
            Column::make("Perfil", "about_me")
                ->sortable(),
            Column::make("Fecha Creación", "created_at")
                ->sortable(),
            Column::make("Actualizadó en", "updated_at")
                ->sortable(),
            Column::make('')
                ->label(
                    function ($row, Column $column) {
                        //$route =  route('admin.preoperacional.moto.imprimir.descargar', $row);
                        $route = route('user.edit', $row);
                        $route1 = route('user.destroy', $row);
                        echo "
                        <a href='$route' class='btn bg-gradient-info btn-sm mb-0' type='button'>Editar</a>
                        <a href='$route1' class='btn bg-gradient-danger btn-sm mb-0' type='button'>Eliminar</a>
                    ";
                    }
                )
                ->html(),
        ];
    }
}
