<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use App\Models\Company;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Mi Negocio',
            'address' => 'La localización geográfica de la empresa',
            'city' => '',
            'state' => '',
            'postal_code' => '',
            'website' => '',
            'email' => '',
            'phone' => '',
            'movil' => '',
            'rif' => '',
            'us' => '',
            'image' => '',
            'ico' => '',
        ]);
       
    }
}
