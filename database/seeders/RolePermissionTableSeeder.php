<?php
namespace Database\Seeders;

use App\Models\Admin\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_permissions')->delete();

        $rolesPermissions = [
            [
                'role_id'    => 1,
                'permission' => 'roles',
            ],
            [
                'role_id'    => 1,
                'permission' => 'roles.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'roles.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'roles.destroy',
            ],
            //////////////////////////////////////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'admins',
            ],
            [
                'role_id'    => 1,
                'permission' => 'admins.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'admins.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'admins.destroy',
            ],

            ///////////////////////////////////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'mainCategories',
            ],
            [
                'role_id'    => 1,
                'permission' => 'mainCategories.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'mainCategories.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'mainCategories.destroy',
            ],

            //////////////////////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'categories',
            ],
            [
                'role_id'    => 1,
                'permission' => 'categories.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'categories.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'categories.destroy',
            ],

            ///////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'brands',
            ],
            [
                'role_id'    => 1,
                'permission' => 'brands.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'brands.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'brands.destroy',
            ],
            ///////////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'ads',
            ],
            [
                'role_id'    => 1,
                'permission' => 'ads.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'ads.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'ads.destroy',
            ],

/////////////////////////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'settings',
            ],
///////////////////////////////////////////////////////////////////

            [
                'role_id'    => 1,
                'permission' => 'terms',
            ],
            [
                'role_id'    => 1,
                'permission' => 'terms.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'terms.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'terms.destroy',
            ],
////////////////////////////////////////////////////////////////

            [
                'role_id'    => 1,
                'permission' => 'about_us',
            ],
            [
                'role_id'    => 1,
                'permission' => 'about_us.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'about_us.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'about_us.destroy',
            ],
///////////////////////////////////////////////////////////contact_us
            [
                'role_id'    => 1,
                'permission' => 'contact_us',
            ],
            [
                'role_id'    => 1,
                'permission' => 'contact_us.destroy',
            ],
///////////////////////////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'governorates',
            ],
            [
                'role_id'    => 1,
                'permission' => 'governorates.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'governorates.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'governorates.destroy',
            ],
/////////////////////////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'cities',
            ],
            [
                'role_id'    => 1,
                'permission' => 'cities.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'cities.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'cities.destroy',
            ],
/////////////////////////////////////////////////////////////////
            [
                'role_id'    => 1,
                'permission' => 'areas',
            ],
            [
                'role_id'    => 1,
                'permission' => 'areas.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'areas.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'areas.destroy',
            ],
////////////////////////////////////////////////////////////////////

            [
                'role_id'    => 1,
                'permission' => 'jobs',
            ],
            [
                'role_id'    => 1,
                'permission' => 'jobs.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'jobs.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'jobs.destroy',
            ],
////////////////////////////////////////////////////////////////////join_requests

            [
                'role_id'    => 1,
                'permission' => 'join_requests',
            ],
            [
                'role_id'    => 1,
                'permission' => 'join_requests.create',
            ],
            [
                'role_id'    => 1,
                'permission' => 'join_requests.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'join_requests.destroy',
            ],
            [
                'role_id'    => 1,
                'permission' => 'join_requests.approval',
            ],
////////////////////////////////////////////////////////////////////

            [
                'role_id'    => 1,
                'permission' => 'clients',
            ],

            [
                'role_id'    => 1,
                'permission' => 'clients.edit',
            ],
            [
                'role_id'    => 1,
                'permission' => 'clients.destroy',
            ],

////////////////////////////////////////////////////////////////////

            // [
            //     'role_id' => 1,
            //     'permission' => 'products',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'products.create',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'products.edit',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'products.destroy',
            // ],
            // [

            // [
            //     'role_id' => 1,
            //     'permission' => 'settings.edit',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'vendors',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'vendors.create',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'vendors.edit',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'vendors.destroy',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'contactus',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'contactus.destroy',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'DeliveryPolicy',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'DeliveryPolicy.create',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'DeliveryPolicy.edit',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'DeliveryPolicy.destroy',
            // ],

            // [
            //     'role_id' => 1,
            //     'permission' => 'emailUs',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'emailUs.destroy',
            // ],

            // [
            //     'role_id' => 1,
            //     'permission' => 'coupons',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'coupons.create',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'coupons.edit',
            // ],
            // [
            //     'role_id' => 1,
            //     'permission' => 'coupons.destroy',
            // ],

        ];

        foreach ($rolesPermissions as $rolesPermission) {
            RolePermission::create($rolesPermission);
        }

    }
}
