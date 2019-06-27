<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/permissions.json";
        $arr = getArrFromJson($path);
        \DB::table('permissions')->insert($arr['data']);
    }
}
