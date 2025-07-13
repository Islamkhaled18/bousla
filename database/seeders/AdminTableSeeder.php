<?php
namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('admins')->delete();

        $admins = [
            [
                'id'       => 1,
                'name'     => 'Super Admin',
                'slug'     => 'super-admin',
                'email'    => 'super_admin@gmail.com',
                'password' => bcrypt('123456789'),
                'phone'    => '01015949894',
                'role_id'  => 1,
            ],
            [
                'id'       => 2,
                'name'     => 'mohamed elabasy',
                'email'    => 'mohamed.elabasy@gmail.com',
                'password' => bcrypt('123456789'),
                'phone'    => '01228772551',
                'role_id'  => 2,
            ],

        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }

    }
}
