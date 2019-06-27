<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class LocaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/locales.json";
        $arr = getArrFromJson($path);
        \DB::table('locales')->insert($arr['data']);
    }
}
