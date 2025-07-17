<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleTableSeeder::class,
            AdminTableSeeder::class,
            RolePermissionTableSeeder::class,
            MainCategoryTableSeeder::class,
            CategoryTableSeeder::class,
            BrandTableSeeder::class,
            AdTableSeeder::class,
            SettingTableSeeder::class,
            TermsConditionsTableSeeder::class,
            AboutUsTableSeeder::class,
            ContactUsTableSeeder::class,
            GovernorateTableSeeder::class,
            CityTableSeeder::class,
            AreaTableSeeder::class,
        ]);
    }
}
