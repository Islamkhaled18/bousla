<?php
namespace Database\Seeders;

use App\Models\Admin\MainCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('main_categories')->delete();

        $mainCategories = [
            [
                'id'    => 1,
                'name'  => 'Medical',
                'slug'  => 'medical',
                'image' => 'mainCategories/1.jpg',
            ],
            [
                'id'    => 2,
                'name'  => 'Home Services',
                'slug'  => 'home-services',
                'image' => 'mainCategories/2.jpg',

            ],

        ];

        foreach ($mainCategories as $manCategory) {
            MainCategory::create($manCategory);
        }
    }
}
