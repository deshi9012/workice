<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/calendars.json";
        $arr = getArrFromJson($path);
        foreach ($arr['data'] as $key => $value) {
            \DB::table('calendars')->insert(
                [
                'name' => $value['name'],
                'created_at' => now(),
                'updated_at' => now()
                ]
            );
        }
    }
}
