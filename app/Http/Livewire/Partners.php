<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Exception\NotReadableException;
use Image;

/**
 * Gestión de clientes/partners comerciales
 *
 * @property string $cedula Identificación única
 * @property mixed $image Foto (convertida a WebP 143x154)
 * @property string $email Contacto principal
 */
class Partners extends Component
{
	use WithFileUploads;
	use WithPagination;

	public $image, $type, $name, $cedula, $address,$contry, $state, $city, $postal_code, $phone, $movil, $email, $website,$search, $selected_id, $pageTitle, $componentName;
	private $pagination = 10;

	public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Clientes';
        $this->type = 'Seleccione';
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    /**
     * @return \Illuminate\View\View
     *
     * - Lista paginada (10 items)
     * - Búsqueda por nombre
     * - Orden descendente por defecto
     */
    public function render()
    {
        if (strlen($this->search) > 0)
    	   $data = Partner::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Partner::orderBy('id','desc')->paginate($this->pagination);

        return view('livewire.partners.component',['data' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    /**
     * Crea nuevo partner
     *
     * - Valida formatos (email, teléfono, web)
     * - Procesa imagen a WebP
     * @event partner-added|partner-error Resultado
     */
    public function Store()
    {
        $rules = [
            'name' => 'required',
            'cedula' => 'required|unique:partners',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|numeric',
            'postal_code' => 'nullable|numeric',
            'movil' => ['nullable', 'regex:/^\+\d{1,3}\s?\d{4,14}$/'],
           'website' => ['nullable', 'regex:/^(https?:\/\/)?(www\.)?[a-z0-9\-]+(\.[a-z0-9\-]+)*(\.[a-z]{2,6})(:[0-9]+)?(\/.*)?$/i'],
        ];

        $messages = [
            'type.not_in' => 'Requerido',
            'name.required' => 'Requerido',
            'cedula.required' => 'Requerido',
            'cedula.unique' => 'Ya existe este número de identificación',
            'email.required' => 'Requerido',
            'email.email' => 'Correo no es valido',
            'address.required' => 'Requerido',
            'phone.required' => 'Requerido',
            'phone.numeric' => 'Es solo números',
            'postal_code.numeric' => 'El campo código postal es solo números.',
            'movil.regex' => 'Formato correcto (+XXXXXXXXXXX).',
            'website.regex' => 'El campo website debe ser una URL válida con el formato "http://", "https://" o "www"',
        ];

        $this->validate($rules, $messages);
        try { 
        $partners = Partner::create([
            'name' => ucwords ($this->name),
            'cedula' => $this->cedula,
            'address' => $this->address,
            'contry' => ucwords ($this->contry),
            'state' => ucwords ($this->state),
            'city' => ucwords ($this->city),
            'postal_code' => $this->postal_code,
            'phone' => $this->phone,
            'movil' => $this->movil,
            'email' => $this->email,
            'website' => $this->website
        ]);

        $customFileName;
        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            Image::make($this->image)->encode('webp', 100)->resize(143, 154)->save('storage/partners/'.$customFileName.'.webp');
            $partners->image = $customFileName.'.webp';
            $partners->save();
        }

        $this->resetUI();
        $this->emit('partner-added','Se ha registrado con exito');
        } catch (NotReadableException $e) {
            $this->emit('partner-error','No puede leer el archivo de imagen');
        }
    }

    /**
     * Prepara datos para edición
     *
     * @param Partner $partners Modelo inyectado
     * @event show-modal Dispara modal
     */
    public function Edit(Partner $partners)
    {
        $this->name = $partners->name;
        $this->cedula = $partners->cedula;
        $this->address = $partners->address;
        $this->contry = $partners->contry;
        $this->state = $partners->state;
        $this->city = $partners->city;
        $this->postal_code = $partners->postal_code;
        $this->phone = $partners->phone;
        $this->movil = $partners->movil;
        $this->email = $partners->email;
        $this->website = $partners->website;
        $this->selected_id = $partners->id;
        $this->image = $partners->image;
              
        $this->emit('show-modal', 'Show Modal!!');
    }

    /**
     * Actualiza partner existente
     *
     * - Reemplaza imagen si cambia
     * - Elimina archivo antiguo
     * @event partner-updated|partner-error Resultado
     */
    public function Update()
    {
        $rules = [
            'name' => 'required',
            'cedula' => "required|unique:partners,cedula,{$this->selected_id}",
            //'email' => 'email',
            'address' => 'required',
            'phone' => 'required',
        ];

        $messages = [
            'name.required' => 'Requerido',
            'cedula.required' => 'Requerido',
            'cedula.unique' => 'Ya existe este número de identificación',
            //'email.email' => 'Correo no es valido',
            'address.required' => 'Requerido',
            'phone.required' => 'Requerido',
        ];

        $this->validate($rules, $messages);
        try { 
        $partners = Partner::find($this->selected_id);

        $partners->update([
            'name' => ucwords ($this->name),
            'cedula' => $this->cedula,
            'address' => $this->address,
            'contry' => ucwords ($this->contry),
            'state' => ucwords ($this->state),
            'city' => ucwords ($this->city),
            'postal_code' => $this->postal_code,
            'phone' => $this->phone,
            'movil' => $this->movil,
            'email' => $this->email,
            'website' => $this->website
        ]);

        $customFileName;
        if($this->image != $partners->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            
            Image::make($this->image)->encode('webp', 100)->resize(143, 154)->save('storage/partners/'.$customFileName.'.webp');
            $imageName = $partners->image;

            $partners->image = $customFileName.'.webp';
            $partners->save();

            if($imageName !=null)
            {
                if(file_exists('storage/partners/' . $imageName))
                {
                    unlink('storage/partners/' . $imageName);
                }
            }
        }

        $this->resetUI();
        $this->emit('partner-updated','Registro Actualizado');
        } catch (NotReadableException $e) {
            $this->emit('partner-error','No puede leer el archivo de imagen');
        }

    }

    protected $listeners = [
        'destroy' => 'Destroy'
    ];

    /**
     * Elimina partner y su imagen asociada
     *
     * @param Partner $partners Modelo inyectado
     * @event partner-deleted Confirmación
     */
    public function Destroy(Partner $partners)
    {

        $imageName = $partners->image;
        $partners->delete();

        if ($imageName != null) {
            unlink('storage/partners/' . $imageName);
        }

        $this->resetUI();
        $this->emit('partner-deleted', 'Se ha eliminado correctamente');
    }



    public function resetUI()
    {
        $this->type = 'Seleccione';
        $this->name = '';
        $this->cedula = '';
        $this->address = '';
        $this->contry = '';
        $this->state = '';
        $this->city = '';
        $this->postal_code = '';
        $this->phone = '';
        $this->movil = '';
        $this->email = '';
        $this->website = '';
        $this->selected_id = 0;
        $this->image = '';
        $this->image = null;
    	$this->resetValidation();
        
    }
}
