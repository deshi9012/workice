<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/statuses.json";
        $arr = getArrFromJson($path);
        \DB::table('status')->insert($arr['data']);
    }
}
