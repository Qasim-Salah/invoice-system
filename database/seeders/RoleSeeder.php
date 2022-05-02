<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "id" => 1,
            "name" => 'supervisor',
            "permissions" => '["invoices", "sections", "invoices-archive", "reports", "users", "settings","roles"]',
        ]);
        Role::create([
            "id" => 2,
            "name" => 'admin',
            "permissions" => '["reports", "settings"]',
        ]);

    }
}
