<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use \App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Category::factory(10)->create();

        //  Role::create(['name' => 'visiter']);
        //  Role::create(['name' => 'publisher']);
    //     $user->assignRole($role);
        //   Permission::create(['name' => 'publish post']);
        $user = User::find(9);
        $user->assignRole('visiter');
        // $role->givePermissionTo('publish post');

    }
}
