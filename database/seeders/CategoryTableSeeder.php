<?php
namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->delete();

        $categories = [
            [
                'id'               => 1,
                'name'             => 'clinics',
                'slug'             => 'clinics',
                'parent_id'        => null,
                'main_category_id' => 1,
            ],
            [
                'id'               => 2,
                'name'             => 'raneen',
                'slug'             => 'raneen',
                'parent_id'        => null,
                'main_category_id' => 2,
            ],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
