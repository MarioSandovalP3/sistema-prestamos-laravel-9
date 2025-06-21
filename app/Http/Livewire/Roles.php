<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;

/**
 * Gestión de roles del sistema
 *
 * @uses Spatie\Permission\Models\Role
 * @property string $roleName Nombre del rol
 */
class Roles extends Component
{
	use WithPagination;
	public $roleName, $search, $selected_id, $pageTitle, $componentName;
	private $pagination = 7;

	public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    /**
     * @return \Illuminate\View\View
     *
     * - Lista paginada de roles (7 items)
     * - Búsqueda por nombre
     * - Orden ascendente por defecto
     */
    public function render()
    {
    	if(strlen($this->search) > 0)
    		$roles = Role::where('name','like','%'. $this->search . '%')->paginate($this->pagination);
    	else
    		$roles = Role::orderBy('id','asc')->paginate($this->pagination);

        return view('livewire.roles.component',[
        	'roles' => $roles
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }


    /**
     * Crea nuevo rol
     *
     * - Valida nombre único (min 3 chars)
     * @event role-added|role-error Resultado
     */
    public function CreateRole(){
    	$rules = ['roleName' => 'required|min:3|unique:roles,name'];

    	$messages = [
    		'roleName.required' => 'Requerido',
    		'roleName.min' => 'El minimo es de 3 carateres',
    		'roleName.unique' => 'El rol ya existe'
    	];

    	$this->validate($rules, $messages);

		try { 
			Role::create(['name' => $this->roleName]);
			$this->emit('role-added','El rol se ha registrado correctamente');
			$this->resetUI();
		} catch (Exception $e) {
        	$this->emit('role-error','Error: '. $e->getMessage());
        }
    }

    /**
     * Prepara rol para edición
     *
     * @param Role $role Modelo inyectado
     * @event show-modal Dispara modal
     */
    public function Edit(Role $role){
    	//$role = Role::find($id);
    	$this->selected_id = $role->id;
    	$this->roleName = $role->name;

    	$this->emit('show-modal','Show Modal');

    }

    /**
     * Actualiza nombre de rol
     *
     * - Valida nombre único excluyendo actual
     * @event role-updated|role-error Resultado
     */
    public function UpdateRole(){
    	$rules = ['roleName' => "required|min:3|unique:roles,name, {$this->selected_id}"];

    	$messages = [
    		'roleName.required' => 'Requerido',
    		'roleName.min' => 'El minimo es de 3 carateres',
    		'roleName.unique' => 'El rol ya existe'
    	];

    	$this->validate($rules, $messages);
		try {
    	$role = Role::find($this->selected_id);
    	$role->name = $this->roleName;
    	$role->save();

    	$this->emit('role-updated','El rol se ha actualizado correctamente');
    	$this->resetUI();
		} catch (Exception $e) {
			$this->emit('role-error','Error: '. $e->getMessage());
		}
    }


    protected $listeners = ['destroy' => 'Destroy'];

    /**
     * Elimina rol si no tiene permisos asociados
     *
     * @param int $id ID del rol
     * @event role-deleted|role-error Resultado
     */
    public function Destroy($id){
    	$permissionsCount = Role::find($id)->permissions->count();
    	if ($permissionsCount > 0) {
    		$this->emit('role-error','El rol no se puede eliminar, contiene permisos asociados');
    	}

    	Role::find($id)->delete();
    	$this->emit('role-deleted','El rol se ha eliminado correctamente');
    }

    public function resetUI(){
        $this->roleName = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
