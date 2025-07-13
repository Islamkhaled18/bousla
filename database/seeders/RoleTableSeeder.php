<?php
namespace Database\Seeders;

use App\Models\Admin\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->delete();

        $roles = [
            [
                'id'   => 1,
                'name' => 'Super Admin',
            ],
            [
                'id'   => 2,
                'name' => 'Admin',
            ],

        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
