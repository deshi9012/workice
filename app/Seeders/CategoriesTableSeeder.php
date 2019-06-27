<?php
namespace App\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/json/categories.json";
        $arr = getArrFromJson($path);
        \DB::table('categories')->insert($arr['data']);
    }
}
