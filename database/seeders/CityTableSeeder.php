<?php
namespace Database\Seeders;

use App\Models\Admin\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->delete();

        $cities = [
            [
                'id'             => 1,
                'name'           => 'مدينة نصر',
                'governorate_id' => 1,
            ],
            [
                'id'             => 2,
                'name'           => 'المحلة الكبرى',
                'governorate_id' => 2,
            ],

        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
