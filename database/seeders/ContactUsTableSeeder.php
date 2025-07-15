<?php
namespace Database\Seeders;

use App\Models\Admin\ContactUs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_us')->delete();

        $contacts = [
            [
                'id'      => 1,
                'name'    => 'Super Admin',
                'slug'    => 'super-admin',
                'email'   => 'super_admin@gmail.com',
                'phone'   => '01015949894',
                'subject' => 'subject',
                'message' => 'message',

            ],
            [
                'id'      => 2,
                'name'    => 'Admin',
                'slug'    => 'admin',
                'email'   => 'admin@gmail.com',
                'phone'   => '01015949894',
                'subject' => 'subject',
                'message' => 'message',

            ],
            [
                'id'      => 3,
                'name'    => 'manager',
                'slug'    => 'manager',
                'email'   => 'manager@gmail.com',
                'phone'   => '01015949894',
                'subject' => 'subject',
                'message' => 'message',

            ],
        ];

        foreach ($contacts as $contact) {
            ContactUs::create($contact);
        }
    }
}
