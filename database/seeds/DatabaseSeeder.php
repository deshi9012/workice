<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            App\Seeders\CategoriesTableSeeder::class,
            App\Seeders\CalendarsTableSeeder::class,
            App\Seeders\ConfigTableSeeder::class,
            App\Seeders\CountriesTableSeeder::class,
            App\Seeders\CurrencyTableSeeder::class,
            App\Seeders\DepartmentTableSeeder::class,
            App\Seeders\GatewayTableSeeder::class,
            App\Seeders\HookTableSeeder::class,
            App\Seeders\LanguageTableSeeder::class,
            App\Seeders\LocaleTableSeeder::class,
            App\Seeders\PermissionTableSeeder::class,
            App\Seeders\PriorityTableSeeder::class,
            App\Seeders\ProjectConfigTableSeeder::class,
            App\Seeders\RoleTableSeeder::class,
            App\Seeders\StatusTableSeeder::class,
            App\Seeders\TaxRateTableSeeder::class,
            App\Seeders\ClauseTableSeeder::class,
        ]);
    }
}
