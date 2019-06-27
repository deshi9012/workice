<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class ClauseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/clauses.json";
        $arr = getArrFromJson($path);
        foreach ($arr['data'] as $key => $value) {
            \DB::table('clauses')->insert(
                [
                'name' => $value['name'],
                'clause' => $value['clause'],
                'updated_at' => now(),
                'created_at' => now(),
                ]
            );
        }
    }
}
