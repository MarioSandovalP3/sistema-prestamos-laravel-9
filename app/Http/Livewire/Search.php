<?php

namespace App\Http\Livewire;

use Livewire\Component;

/**
 * Componente de búsqueda básico
 *
 * @property string $search Término de búsqueda
 */
class Search extends Component
{
	public $search;
    /**
     * Renderiza vista de búsqueda
     */
    public function render()
    {
        return view('livewire.search');
    }
}
