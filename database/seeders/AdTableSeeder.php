<?php
namespace Database\Seeders;

use App\Models\Admin\Ad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ads')->delete();

        $ads = [
            [
                'id'       => 1,
                'name'     => 'اعلان اول',
                'brand_id' => 1,

            ],
            [
                'id'       => 2,
                'name'     => 'اعلان ثاني',
                'brand_id' => 2,
            ],

        ];

        foreach ($ads as $ad) {
            Ad::create($ad);
        }
    }
}
