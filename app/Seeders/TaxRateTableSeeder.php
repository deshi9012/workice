<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class TaxRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/tax_rates.json";
        $arr = getArrFromJson($path);
        foreach ($arr['data'] as $key => $value) {
            \DB::table('tax_rates')->insert(
                [
                'name' => $value['name'],
                'rate' => $value['rate'],
                ]
            );
        }
    }
}
