<?php
namespace Database\Seeders;

use App\Models\Admin\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_titles')->delete();

        $jobs = [
            [
                'id'   => 1,
                'name' => 'عميل',
            ],
            [
                'id'   => 2,
                'name' => 'طبيب',
            ],
            [
                'id'   => 3,
                'name' => 'نجار',
            ],

        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
