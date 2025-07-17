<?php

namespace Database\Seeders;

use App\Models\Admin\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('governorates')->delete();

        $governorates = [
            [
                'id'       => 1,
                'name'     => 'القاهرة',
            ],
            [
                'id'       => 2,
                'name'     => 'الغربيه',
            ],

        ];

        foreach ($governorates as $governorate) {
            Governorate::create($governorate);
        }
    }
}
