<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class PriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/priorities.json";
        $arr = getArrFromJson($path);
        foreach ($arr['data'] as $key => $value) {
            \DB::table('priorities')->insert(
                [
                'priority' => $value['priority'],
                ]
            );
        }
    }
}
