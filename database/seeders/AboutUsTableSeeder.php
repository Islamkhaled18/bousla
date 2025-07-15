<?php
namespace Database\Seeders;

use App\Models\Admin\Aboutus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('aboutuses')->delete();

        $aboutuses = [
            [
                'id'   => 1,
                'text' => 'شروط واحكام شروط واحكام شروط واحكام ',
            ],

        ];

        foreach ($aboutuses as $aboutus) {
            Aboutus::create($aboutus);
        }
    }
}
