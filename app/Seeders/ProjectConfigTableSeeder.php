<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class ProjectConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/project_config.json";
        $arr = getArrFromJson($path);
        \DB::table('project_settings')->insert($arr['data']);
    }
}
