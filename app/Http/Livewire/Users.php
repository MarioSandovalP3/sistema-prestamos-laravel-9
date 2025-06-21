<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;
use Intervention\Image\Exception\NotReadableException;
/**
 * Gestión completa de usuarios del sistema
 *
 * @property string $email Email único
 * @property string $profile Rol asignado
 * @property mixed $image Foto (WebP 200x200)
 */
class Users extends Component
{
	use WithFileUploads;
	use WithPagination;

	public $name,$phone,$email,$status,$profile,$image,$password,$selected_id,$fileLoaded;
	public $pageTitle,$componentName, $search,$passwordEdit;
	private $pagination = 15;

	public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
        $this->status = 'Seleccione';
        $this->profile = 'Seleccione';

    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    /**
     * @return \Illuminate\View\View
     *
     * - Lista paginada de usuarios (15 items)
     * - Búsqueda por nombre
     * - Carga roles disponibles
     */
    public function render()
    {
    	if (strlen($this->search) > 0) {
    		$data = User::where('name','like','%' . $this->search . '%')
    		->select('*')
    		->orderBy('name','asc')->paginate($this->pagination);
    	}
    	else{
    		$data = User::select('*')
    		->orderBy('name','asc')->paginate($this->pagination);
    	}

        return view('livewire.users.component',[
        	'data' => $data,
        	'roles' => Role::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }


    /**
     * Prepara usuario para edición
     *
     * @param User $user Modelo inyectado
     * @event show-modal Dispara modal
     */
    public function Edit(User $user){
    	$this->selected_id = $user->id;
    	$this->name = $user->name;
    	$this->phone = $user->phone;
    	$this->profile = $user->profile;
    	$this->status = $user->status;
    	$this->email = $user->email;
    	$this->password = '';
        $this->passwordEdit = '';
    	$this->image = $user->image;
        

    	$this->emit('show-modal','Abrir!');
    }


    /**
     * Crea nuevo usuario
     *
     * - Valida datos requeridos
     * - Hashea contraseña
     * - Procesa imagen a WebP
     * @event user-added|user-error Resultado
     */
    public function Store(){

    	$rules = [
    		'name' => 'required|min:3',
    		'email' => 'required|unique:users|email',
    		'status' => 'required|not_in:Seleccione',
    		'profile' => 'required|not_in:Seleccione',
    		'password' => 'required|min:8',
            'phone' => 'required|numeric',
            
    	];
    	$messages = [
    		'name.required' => 'Requerido',
    		'name.min' => 'Debe tener almenos 3 carateres',
    		'email.required' => 'Requerido',
    		'email.unique' => 'Ya existe en el sistema',
    		'email.email' => 'No valido',
    		'status.required' => 'Requerido',
    		'status.not_in' => 'Requerido',
    		'profile.required' => 'Requerido',
    		'profile.not_in' => 'Requerido',
    		'password.required' => 'Requerido',
    		'password.min' => 'Debe contener almenos 8 carateres',
            'phone.required' => 'Requerido',
            'phone.numeric' => 'Es solo números',
    	];

    	$this->validate($rules,$messages);
        try { 
    	$user = User::create([
    		'name' => $this->name,
    		'email' => $this->email,
    		'password' => Hash::make($this->password),
    		'phone' => $this->phone,
    		'profile' => $this->profile,
    		'status' => $this->status
    	]);

        $user->syncRoles($this->profile);

    	if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            Image::make($this->image)->encode('webp', 90)->resize(200, 200)->save('storage/users/'.$customFileName.'.webp');
            $user->image = $customFileName.'.webp';
            $user->save();
        }

        $this->resetUI();
        $this->emit('user-added', 'Usuario Registrado');
        } catch (NotReadableException $e) {
            $this->emit('user-error','No puede leer el archivo de imagen');
        }
    }

    /**
     * Actualiza usuario existente
     *
     * - Actualiza contraseña solo si se proporciona
     * - Reemplaza imagen si cambia
     * @event user-updated|user-error Resultado
     */
    public function Update(){
    	$rules = [
    		'email' => "required|unique:users,email,{$this->selected_id}",
    		'name' => 'required|min:3',		
    		'status' => 'required|not_in:Seleccione',
    		'profile' => 'required|not_in:Seleccione',
    		//'password' => 'required|min:8',
            'phone' => 'required|numeric',

    	];
    	$messages = [
    		'name.required' => 'Requerido',
    		'name.min' => 'Debe tener almenos 3 carateres',
    		'email.required' => 'Requerido',
    		'email.unique' => 'El correo ya existe en el sistema',
    		'email.email' => 'Correo no valido',
    		'status.required' => 'Requerido',
    		'status.not_in' => 'Requerido',
    		'profile.required' => 'Requerido',
    		'profile.not_in' => 'Requerido',
    		//'password.required' => 'La contraseña es requerida',
    		//'password.min' => 'Debe contener almenos 8 carateres',
            'phone.required' => 'Requerido',
            'phone.numeric' => 'Es solo números',
    	];

    	$this->validate($rules,$messages);
        try { 
        $user = User::find($this->selected_id);
        if ($this->password) {
            $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'profile' => $this->profile,
            'status' => $this->status
        ]);
        }else{
            $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile' => $this->profile,
            'status' => $this->status
        ]);
        }
    	
        $user->syncRoles($this->profile);

    	if($this->image != $user->image)
        {

            $customFileName = uniqid() . '_.' . $this->image->extension();
            Image::make($this->image)->encode('webp', 90)->resize(200, 200)->save('storage/users/'.$customFileName.'.webp');
            $imageName = $user->image;
            $user->image = $customFileName.'.webp';
            $user->save();

            if($imageName !=null)
            {
                if(file_exists('storage/users/' . $imageName))
                {
                    unlink('storage/users/' . $imageName);
                }
            }
        }

        $this->resetUI();
        $this->emit('user-updated', 'Usuario Actualizado');
        } catch (NotReadableException $e) {
            $this->emit('user-error','No puede leer el archivo de imagen');
        }

    }

    /**
     * Actualiza contraseña de usuario
     *
     * - Valida mínimo 8 caracteres
     * - Usa bcrypt para hashing
     * @event reset-passwd Confirmación
     */
    public function updatePasswd(){
        $rules = [
            'passwordEdit' => 'required|min:8'

        ];
        $messages = [
            'passwordEdit.required' => 'La contraseña es requerida',
            'passwordEdit.min' => 'Debe contener almenos 8 carateres'
        ];

        $this->validate($rules,$messages);
        try {
        $user = User::find($this->selected_id);

        $user->update([
            'password' => bcrypt($this->passwordEdit),

        ]); 
        $this->emit('reset-passwd', 'Contraseña actualizada');
        } catch (Exception $e) {
        $this->emit('user-error','Error: '. $e->getMessage());
        }


    }

    protected $listeners = [
    	'destroy' => 'Destroy',
    ];

    public function Destroy(User $user)
    {
    	if ($user) {		
    			$imageName = $user->image;
    			if ($imageName != null) {
           		 unlink('storage/users/' . $imageName);
        		}
        		$user->delete();
        		$this->resetUI();
        		$this->emit('user-deleted', 'Usuario Eliminado');
    		
    	}
        
    }
    
    public function resetUI(){
        
        $this->status = 'Seleccione';
        $this->profile = 'Seleccione';
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->password = '';
        $this->passwordEdit = '';
        $this->selected_id = 0;
        $this->image = null;
    	$this->resetValidation();
    	

    }
    public function closePasswd(){
      
        $this->emit('close-passwd', '');

    }
     public function resetPasswd(){

        $this->resetValidation();
        
    }


}
