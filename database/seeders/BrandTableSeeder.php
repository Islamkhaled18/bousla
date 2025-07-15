<?php
namespace Database\Seeders;

use App\Models\Admin\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->delete();

        $brands = [
            [
                'id'   => 1,
                'name' => 'Panadol',
                'slug' => 'panadol',

            ],
            [
                'id'   => 2,
                'name' => 'Cataflam',
                'slug' => 'cataflam',
            ],

        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
