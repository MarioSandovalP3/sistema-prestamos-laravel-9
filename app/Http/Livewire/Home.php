<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\User;
use App\Models\Partner;
use Livewire\Component;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\DB;


/**
 * Dashboard principal con métricas del sistema
 *
 * - Estadísticas de usuarios, clientes y préstamos
 * - Datos para gráficos mensuales
 * - Configura regionalización ES para fechas
 */
class Home extends Component
{
	public $name,$image,$mensaje;

    /**
     * @return \Illuminate\View\View
     *
     * - Consultas SQL para métricas clave
     * - Procesa datos para gráficos:
     *   - $partner: Registros mensuales de clientes
     *   - $data: Ganancias mensuales de préstamos
     * - Estructura de retorno:
     *   - Counters: usuarios, clientes, préstamos
     *   - Datos gráficos en formato JSON
     */
    public function render()
    {
        DB::statement("SET lc_time_names = 'es_ES'");
    	setlocale(LC_ALL,"es_ES");


    	$users = User::count();
        $users_active = User::where('status','Active')->count();
        $users_inactive = User::where('status','Locked')->count();
        $clients = Partner::count();
        $loans = Loan::count();
        $loans_complete = Loan::where('status','Pagado')->count();
        $loans_pending = Loan::where('status','Pendiente')->count();
        $loans_cancel = Loan::where('status','Cancelado')->count();


        $partner = [];
    	$totalPartner = 0;
    	
    	$totalMesPartner = DB::select("  
            SELECT monthname(created_at) AS mes_registro,
            COUNT(*) AS cantidad_partners
            FROM 
                partners
            GROUP BY 
                monthname(created_at)
            ORDER BY 
                mes_registro;
        ");  	

    	foreach ($totalMesPartner as $value) {
    		$partner['labelPartner'][] = strtoupper($value->mes_registro);
    		$partner['partner'][] = $value->cantidad_partners;
            $totalPartner += $value->cantidad_partners;
    	}

        $partner['dataTotalPartner'] = $totalPartner; // Aquí no necesitas un array, ya que es un único valor.
        $partner = json_encode($partner); // Aquí conviertes todo el array a JSON.



        $data = [];
    	$totalLoan = 0;
    	
    	$totalMes = DB::select("select monthname(date) as mes, sum(earnings) as totalmes from loans where status = 'Pagado' group by monthname(date) order by monthname(date) asc limit 12");  	

    	foreach ($totalMes as $value) {
    		$data['label'][] = strtoupper($value->mes);
    		$data['data'][] = $value->totalmes;
    		$totalLoan += $value->totalmes;
    	}

        
        $data['dataMesTotal'] = $totalLoan; // Aquí no necesitas un array, ya que es un único valor.
        $data = json_encode($data); // Aquí conviertes todo el array a JSON.

        return view('livewire.home.component',[
        	'users' => $users,
            'users_active' => $users_active,
            'users_inactive' => $users_inactive,
            'clients' => $clients,
            'loans' => $loans,
            'loans_complete' => $loans_complete,
            'loans_pending' => $loans_pending,
            'loans_cancel' => $loans_cancel,
            'data' => $data,
            'partner' => $partner,
        ])->extends('layouts.theme.app')->section('content');
    }
}
