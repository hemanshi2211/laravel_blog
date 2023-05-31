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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'writer']);
        Role::create(['name' => 'publisher']);
        Role::create(['name' => 'visitor']);
        Role::create(['name' => 'editor']);

        Permission::create(['name' => 'write post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'publish post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'write category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'write user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'write role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);


        $role = Role::findById(1);
        $role->syncPermissions(['write post', 'edit post', 'publish post','delete post','write category','edit category','delete category','write user','edit user','delete user','write role','edit role','delete role']);
        $role = Role::findById(2);
        $permission = Permission::findById(1);
        $role->givePermissionTo($permission);
        $role = Role::findById(3);
        $permission = Permission::findById(3);
        $role->givePermissionTo($permission);
        $role = Role::findById(5);
        $permission = Permission::findById(2);
        $role->givePermissionTo($permission);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('admin');
        $user = \App\Models\User::factory()->create([
            'name' => 'hemanshi',
            'email' => 'hemanshi@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('writer');
        $user = \App\Models\User::factory()->create([
            'name' => 'rohit',
            'email' => 'rohit@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('publisher');
        $user = \App\Models\User::factory()->create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('visitor');
        $user = \App\Models\User::factory()->create([
            'name' => 'shyam',
            'email' => 'shyam@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('editor');

        $food = Category::create([
            'name' => 'food'
        ]);
        $environment = Category::create([
            'name' => 'environment'
        ]);
        $work = Category::create([
            'name' => 'work'
        ]);
        $thought = Category::create([
            'name' => 'thought'
        ]);
    }
}
