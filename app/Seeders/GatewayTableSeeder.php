<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class GatewayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/gateways.json";
        $arr = getArrFromJson($path);
        \DB::table('payment_methods')->insert($arr['data']);
    }
}
