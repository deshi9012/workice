<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/currencies.json";
        $arr = getArrFromJson($path);
        \DB::table('currencies')->insert($arr['data']);
    }
}
