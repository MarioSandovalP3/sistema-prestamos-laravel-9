<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use DB;

/**
 * Gestiona la relación muchos-a-muchos entre roles y permisos
 *
 * @uses Spatie\Permission\Models\Role
 * @uses Spatie\Permission\Models\Permission
 */
class Asignar extends Component
{
    use WithPagination;
    public $role,
        $componentName,
        $selected_id = [],
        $old_permissions = [];
    private $pagination = 15;

    /**
     * @property string $role Rol seleccionado
     * @property string $componentName Nombre del componente
     * @property array $selected_ids Permisos seleccionados
     * @property array $old_permissions Permisos anteriores
     */
    public function mount()
    {
        $this->role = "Seleccione";
        $this->componentName = "Asignar permisos";
    }

    /**
     * Especifica la vista personalizada para la paginación
     *
     * @return string Ruta de la vista de paginación
     */
    public function paginationView()
    {
        return "livewire.pagination";
    }

    /**
     * @return \Illuminate\View\View
     *
     * - Consulta paginada de permisos (15 por página)
     * - Si hay rol seleccionado:
     *   - Obtiene permisos asignados via role_has_permissions
     *   - Marca checked=1 para permisos asignados
     */
    public function render()
    {
        $permisos = Permission::select("name", "id", DB::raw("0 as checked"))
            ->orderBy("id", "asc")
            ->paginate($this->pagination);

        if ($this->role != "Seleccione") {
            $list = Permission::join(
                "role_has_permissions as rp",
                "rp.permission_id",
                "permissions.id"
            )
                ->where("role_id", $this->role)
                ->pluck("permissions.id")
                ->toArray();

            $this->old_permissions = $list;
        }
        if ($this->role != "Seleccione") {
            foreach ($permisos as $permiso) {
                $role = Role::find($this->role);

                $tienePermiso = $role->hasPermissionTo($permiso->name);
                if ($tienePermiso) {
                    $permiso->checked = 1;
                }
            }
        }

        return view("livewire.asignar.component", [
            "roles" => Role::all(),
            "permisos" => $permisos,
        ])
            ->extends("layouts.theme.app")
            ->section("content");
    }

    protected $listeners = ['revokeall' => 'RemoveAll'];

    /**
     * Revoca masivamente permisos mediante syncPermissions([0])
     *
     * @event sync-error Emitido cuando role='Seleccione'
     * @event removeall Confirmación de operación exitosa
     */
    public function RemoveAll()
    {
        \Log::info('RemoveAll function called'); // Debug log
        
        if ($this->role == "Seleccione") {
            $this->emit("sync-error", "Seleccione un role valido");
            return;
        }
        $role = Role::find($this->role);
        $role->syncPermissions([0]);

        $this->emit(
            "removeall",
            "Todos los permisos se han revocado al role $role->name"
        );
    }

    /**
     * Sincronización masiva de permisos via syncPermissions()
     *
     * @event sync-error Emitido cuando role='Seleccione'
     * @event removeall Confirmación con nombre del rol afectado
     */
    public function SyncAll()
    {
        if ($this->role == "Seleccione") {
            $this->emit("sync-error", "Seleccione un role valido");
            return;
        }
        $role = Role::find($this->role);
        $permisos = Permission::pluck("id")->toArray();
        $role->syncPermissions($permisos);

        $this->emit(
            "removeall",
            "Todos los permisos se han sincronizados al role $role->name"
        );
    }

    /**
     * Gestión granular de permisos via give/revokePermissionTo
     *
     * @param bool $state Asignar (true) o revocar (false)
     * @param string $permisoName Nombre del permiso (slug)
     *
     * @event permi|permi-error Resultado de la operación
     */
    public function SyncPermiso($state, $permisoName)
    {
        if ($this->role != "Seleccione") {
            $roleName = Role::find($this->role);

            if ($state) {
                $roleName->givePermissionTo($permisoName);

                $this->emit("permi", "Permiso asignado");
            } else {
                $roleName->revokePermissionTo($permisoName);

                $this->emit("permi", "Permiso revocado");
            }
        } else {
            $this->emit("permi-error", "Seleccione un role");
        }
    }
}
