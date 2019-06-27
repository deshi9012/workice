<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/countries.json";
        $arr = getArrFromJson($path);

        \DB::table('countries')->insert($arr['data']);
    }
}
