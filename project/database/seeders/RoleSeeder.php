<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public array $roles = [
        'User',
        'Manager',
        'Admin',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            Role::query()->insert([
                'role_name' => $role,
            ]);
        }
    }
}
