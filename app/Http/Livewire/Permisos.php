<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;

/**
 * Gestión de permisos del sistema
 *
 * @uses Spatie\Permission\Models\Permission
 * @property string $permissionName Nombre del permiso
 */
class Permisos extends Component
{
	use WithPagination;
	public  $permissionName, $search,$selected_id, $pageTitle, $componentName;
	private $pagination = 15;

	public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    /**
     * @return \Illuminate\View\View
     *
     * - Lista paginada de permisos (15 items)
     * - Búsqueda por nombre
     * - Orden ascendente por defecto
     */
    public function render()
    {
    	if(strlen($this->search) > 0)
    		$permisos = Permission::where('name','like','%'. $this->search . '%')->paginate($this->pagination);
    	else
    		$permisos = Permission::orderBy('id','asc')->paginate($this->pagination);

        return view('livewire.permisos.component',[
        	'permisos' => $permisos
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }


    /**
     * Crea nuevo permiso
     *
     * - Valida nombre único (min 3 chars)
     * @event permiso-added|permiso-error Resultado
     */
    public function CreatePermission(){
    	$rules = ['permissionName' => 'required|min:3|unique:permissions,name'];

    	$messages = [
    		'permissionName.required' => 'Requerido',
    		'permissionName.min' => 'El minimo es de 3 carateres',
    		'permissionName.unique' => 'El permiso ya existe'
    	];

    	$this->validate($rules, $messages);
		try { 
			Permission::create(['name' => $this->permissionName]);
			$this->emit('permiso-added','El permiso se ha registrado correctamente');
			$this->resetUI();
		} catch (Exception $e) {
        	$this->emit('permiso-error','Error: '. $e->getMessage());
        }
    }

    /**
     * Prepara permiso para edición
     *
     * @param Permission $permission Modelo inyectado
     * @event show-modal Dispara modal
     */
    public function Edit(Permission $permission){
    	//$role = Role::find($id);
    	$this->selected_id = $permission->id;
    	$this->permissionName = $permission->name;

    	$this->emit('show-modal','Show Modal');

    }

    /**
     * Actualiza nombre de permiso
     *
     * - Valida nombre único excluyendo actual
     * @event permiso-updated|permiso-error Resultado
     */
    public function UpdatePermission(){
    	$rules = ['permissionName' => "required|min:3|unique:permissions,name, {$this->selected_id}"];

    	$messages = [
    		'permissionName.required' => 'Requerido',
    		'permissionName.min' => 'El minimo es de 3 carateres',
    		'permissionName.unique' => 'El permiso ya existe'
    	];

    	$this->validate($rules, $messages);
		try {
			$permission = Permission::find($this->selected_id);
			$permission->name = $this->permissionName;
			$permission->save();

			$this->emit('permiso-updated','El permiso se ha actualizado correctamente');
			$this->resetUI();
		} catch (Exception $e) {
        	$this->emit('permiso-error','Error: '. $e->getMessage());
        }
    }


    protected $listeners = ['destroy' => 'Destroy'];

    /**
     * Elimina permiso si no tiene roles asociados
     *
     * @param int $id ID del permiso
     * @event permiso-deleted|permiso-error Resultado
     */
    public function Destroy($id){
    	$rolesCount = Permission::find($id)->getRoleNames()->count();
    	if ($rolesCount > 0) {
    		$this->emit('permiso-error','El permiso no se puede eliminar, contiene roles asociados');
    	}

    	Permission::find($id)->delete();
    	$this->emit('permiso-deleted','El permiso se ha eliminado correctamente');
    }

    public function resetUI(){
        $this->permissionName = '';
        $this->selected_id = 0;
    	$this->resetValidation();
    }
}
