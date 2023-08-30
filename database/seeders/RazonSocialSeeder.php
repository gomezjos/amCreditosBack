<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RazonSocial;

class RazonSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RazonSocial::create([
            'razon_idrazon' => 1,
            'razon_nombre' => 'Empresa 2',
            'razon_urltoke' =>  NULL,
            'razon_urlbase' =>  NULL,
            'razon_apiuser' =>  NULL,
            'razon_subscriptionkey' =>  NULL,
            'razon_apipassword' =>  NULL,
            'razon_iva' =>  NULL,
        ]);

        RazonSocial::create([
            'razon_idrazon' => 2,
            'razon_nombre' => 'Empresa 1',
            'razon_urltoke' =>  'https://siigonube.siigo.com:50050/connect/token',
            'razon_urlbase' =>  'http://siigoapi.azure-api.net/siigo/api/v1',
            'razon_apiuser' =>  '',
            'razon_subscriptionkey' =>  '',
            'razon_apipassword' =>  '',
            'razon_iva' =>  19,
        ]);
    }
}
