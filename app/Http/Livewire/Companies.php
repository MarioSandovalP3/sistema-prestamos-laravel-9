<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use DB;
use Image;
use Illuminate\Support\Str;
use Intervention\Image\Exception\NotReadableException;

/**
 * Gestiona los datos maestros de la compañía
 *
 * @property string $name Nombre comercial
 * @property string $address Dirección física
 * @property mixed $image Logo principal (WebP)
 * @property mixed $ico Icono (PNG 144x144)
 * @property string $us Contenido HTML de "Nosotros"
 */
class Companies extends Component
{
    use WithFileUploads;

    public $selected_id,
        $name,
        $address,
        $city,
        $state,
        $postal_code,
        $website,
        $email,
        $phone,
        $movil,
        $rif,
        $image,
        $ico,
        $us,
        $search,
        $iframe_map,
        $slogan;

    /**
     * Inicializa nombre del componente
     */
    public function mount()
    {
        $this->componentName = "Compañia";
    }

    /**
     * @return \Illuminate\View\View
     *
     * - Obtiene registro único de compañía (ID=1)
     * - Extiende layout theme.app
     */
    public function render()
    {
        $data = Company::where("companies.id", 1)->get();

        return view("livewire.company.component", [
            "data" => $data,
        ])
            ->extends("layouts.theme.app")
            ->section("content");
    }

    /**
     * Prepara datos para edición en modal
     *
     * @param Company $company Modelo inyectado
     * @event modal-show Dispara apertura de modal
     */
    public function Edit(Company $company)
    {
        $this->name = $company->name;
        $this->address = $company->address;
        $this->city = $company->city;
        $this->state = $company->state;
        $this->postal_code = $company->postal_code;
        $this->website = $company->website;
        $this->email = $company->email;
        $this->phone = $company->phone;
        $this->movil = $company->movil;
        $this->rif = $company->rif;
        $this->image = $company->image;
        $this->slogan = $company->slogan;
        $this->us = $company->us;
        $this->iframe_map = $company->iframe_map;

        $this->emit("modal-show", "modal show");
    }

    /**
     * Actualiza datos principales de la compañía
     *
     * - Valida campos requeridos y formatos
     * - Procesa imágenes (WebP + PNG icon)
     * - Elimina archivos antiguos si existen
     *
     * @event company-updated|company-error Resultado de operación
     * @throws NotReadableException Si hay error procesando imágenes
     */
    public function Update()
    {
        $rules = [
            "name" => "required",
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "phone" => "required|numeric",
            "movil" => ["nullable", "max:25", 'regex:/^\+\d{1,3}\s?\d{4,14}$/'],
            "email" => "nullable|email",
            "website" => [
                "nullable",
                'regex:/^(https?:\/\/)?(www\.)?[a-z0-9\-]+(\.[a-z0-9\-]+)*(\.[a-z]{2,6})(:[0-9]+)?(\/.*)?$/i',
            ],
        ];

        $messages = [
            "name.required" => "Requerido",
            "address.required" => "Requerida",
            "city.required" => "Requerida",
            "state.required" => "Requerido",
            "phone.required" => "Requerido",
            "phone.numeric" => "Es solo números",
            "movil.regex" => "Formato correcto (+XXXXXXXXXXX)",
            "movil.max" => "Maximo 25 caracteres",
            "email.email" => "No es valido",
            "website.regex" =>
                'Debe ser una URL válida con el formato "http://", "https://" o "www".',
        ];

        $this->validate($rules, $messages);

        try {
            $company = Company::find(1);

            $company->update([
                "name" => $this->name,
                "address" => $this->address,
                "city" => $this->city,
                "state" => $this->state,
                "postal_code" => $this->postal_code,
                "website" => $this->website,
                "email" => $this->email,
                "phone" => $this->phone,
                "movil" => $this->movil,
                "rif" => $this->rif,
                "slogan" => $this->slogan,
                "us" => $this->us,
                "iframe_map" => $this->iframe_map,
            ]);

            $slug_name = strip_tags($this->name);
            $slug_lower = strtolower($slug_name);
            $slug = Str::slug($slug_lower);
            $img_slug = Str::of($slug . "-" . uniqid())
                ->slug("-")
                ->limit(255 - mb_strlen(uniqid()) - 1, "")
                ->trim("-");

            if (is_array($this->image) || is_object($this->image)) {
                if ($this->image != $company->image) {
                    Image::make($this->image)
                        ->encode("webp", 80)
                        ->save("storage/companies/" . $img_slug . ".webp");
                    $imageName = $company->image;

                    Image::make($this->image)
                        ->encode("png", 50)
                        ->resize(144, 144)
                        ->save("storage/companies/icons/" . $img_slug . ".png");
                    $imageIco = $company->ico;
                    $icoName = $imageIco;
                    $company->image = $img_slug . ".webp";
                    $company->ico = $img_slug . ".png";

                    $company->save();

                    if ($imageName != null) {
                        if (file_exists("storage/companies/" . $imageName)) {
                            unlink("storage/companies/" . $imageName);
                            unlink("storage/companies/icons/" . $icoName);
                        }
                    }
                }
            }

            $this->resetUI();
            $this->emit("company-updated", "Compañia Actualizada");
        } catch (NotReadableException $e) {
            $this->emit("company-error", "No puede leer el archivo de imagen");
        }
    }

    /**
     * Prepara contenido de "Nosotros" para edición
     *
     * @param Company $company Modelo inyectado
     * @event modal-us Dispara modal de edición
     */
    public function EditUs(Company $company)
    {
        $this->us = $company->us;
        $this->emit("edit-us", $company->us);
        $this->emit("modal-us", "modal show");
    }

    /**
     * Actualiza sección "Nosotros"
     *
     * @event us-updated|company-error Resultado de operación
     */
    public function Us()
    {
        $rules = [
            "us" => "required",
        ];

        $messages = [
            "us.required" => "Requerido",
        ];

        $this->validate($rules, $messages);

        try {
            $company = Company::find(1);
            $company->update([
                "us" => $this->us,
            ]);

            $this->resetUIUs();
            $this->emit("us-updated", "Actualizado correctamente");
        } catch (Exception $e) {
            $this->emit("company-error", "Error: " . $e->getMessage());
        }
    }

    public function resetUIUs()
    {
        $this->us = "";
        $this->emit("clear-us", "");
        $this->resetValidation();
    }

    public function resetUI()
    {
        $this->name = "";
        $this->address = "";
        $this->city = "";
        $this->state = "";
        $this->postal_code = "";
        $this->website = "";
        $this->phone = "";
        $this->movil = "";
        $this->rif = "";
        $this->currency_symbol = "";
        $this->tax = "";
        $this->divisaid = "Seleccione";
        $this->image = null;
        $this->us = "";
        $this->emit("clear-imagen", "");
        $this->resetValidation();
    }
}
