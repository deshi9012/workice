<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class HookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/hooks.json";
        $arr = getArrFromJson($path);
        \DB::table('hooks')->insert($arr['data']);
    }
}
