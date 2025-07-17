<?php
namespace Database\Seeders;

use App\Models\Admin\Area;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->delete();

        $areas = [
            [
                'id'      => 1,
                'name'    => 'الحى العاشر',
                'city_id' => 1,
            ],
            [
                'id'      => 2,
                'name'    => 'الشعبيه',
                'city_id' => 2,
            ],

        ];

        foreach ($areas as $area) {
            Area::create($area);
        }

    }
}
