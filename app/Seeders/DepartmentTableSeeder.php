<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/departments.json";
        $arr = getArrFromJson($path);
        foreach ($arr['data'] as $key => $value) {
            \DB::table('departments')->insert(
                [
                'deptname' => $value['deptname'],
                ]
            );
        }
    }
}
