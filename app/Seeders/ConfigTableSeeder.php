<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/config.json";
        $arr = getArrFromJson($path);
        \DB::table('config')->insert($arr['data']);
    }
}
