<?php

use Illuminate\Database\Seeder;
use Wavvve\Role;
use Wavvve\Permission;

class DatabaseSeeder extends Seeder{
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'support',
            'display_name' => 'Support',
            'description' => 'Level One/Two Tech Support',
        ]);
        DB::table('roles')->insert([
            'name' => 'sales',
            'display_name' => 'Sales',
            'description' => 'Sales Staff Member',
        ]);
        DB::table('roles')->insert([
            'name' => 'development',
            'display_name' => 'Development Team',
            'description' => 'Development Staff Member',
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Administrative Account',
        ]);
        DB::table('permissions')->insert([
            'name' => 'change_user_info',
            'display_name' => 'Change the information on a user account',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete_user',
            'display_name' => 'Delete a user',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create_pass_for_user',
            'display_name' => 'Create a pass for a user',
        ]);
        DB::table('permissions')->insert([
            'name' => 'enroll_user',
            'display_name' => 'Enroll a new user',
        ]);
        DB::table('permissions')->insert([
            'name' => 'access_sales_console',
            'display_name' => 'Access the sales console',
        ]);
    }
}