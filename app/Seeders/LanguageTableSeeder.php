<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/languages.json";
        $arr = getArrFromJson($path);
        \DB::table('languages')->insert($arr['data']);
    }
}
